<x-filament-panels::page>
    <div class="peta-kasultanan-container">
        <div class="map-container-wrapper">
            <div id="map" class="map-element"></div>

            <div id="data-container" class="data-container">
                <p id="location-header" class="location-header">
                    @if($kalkel_id && $nama_kalurahan)
                        Kalurahan: {{ $nama_kalurahan }}
                    @else
                        Pilih kalurahan untuk menampilkan data
                    @endif
                </p>

                <div id="scrollable-table-container" class="scrollable-table-container">
                    <div id="loading-table-spinner" class="loading-spinner-container">
                        <div class="spinner"></div>
                        <p>Memuat data...</p>
                    </div>

                    <table id="data-table" class="data-table-style">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Penggunaan</th>
                                <th id="sort-luas">Luas <span class="sort-indicator"></span></th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>

                    <div id="no-data-message" class="no-data-message">
                        @if($kalkel_id)
                            Memuat data tanah...
                        @else
                            Pilih kalurahan untuk menampilkan data.
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div id="loading-spinner" class="full-page-loading-spinner"></div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/ol@v8.2.0/dist/ol.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ol@v8.2.0/ol.css">

    <script>
        let map = null;
        let batasKalurahanVector = null;
        let semuaBatasKalurahanVector = null;
        let tanahKasultananVector = null;
        let highlightLayer = null;
        let currentKalkelId = null;
        let currentMapType = 'imagery';
        let currentlyHighlightedFeature = null;

        function initializeMap(kalkelId) {
            console.log("Initializing map with kalkelId:", kalkelId);
            currentKalkelId = kalkelId;

            if (map) {
                map.setTarget(null);
                map = null;
            }

            const spinner = document.getElementById('loading-spinner');
            const tableSpinner = document.getElementById("loading-table-spinner");
            const dataTable = document.getElementById("data-table");
            const noDataMessage = document.getElementById("no-data-message");
            const locationHeader = document.getElementById("location-header");

            spinner.style.display = 'block';
            tableSpinner.style.display = 'none';
            dataTable.style.display = 'none';
            noDataMessage.style.display = 'block';
            locationHeader.innerHTML = kalkelId ? 'Memuat data...' : 'Pilih kalurahan untuk menampilkan data';

            const mapElement = document.getElementById('map');
            mapElement.innerHTML = '';

            const baseLayer = currentMapType === 'imagery'
                ? new ol.layer.Tile({
                    source: new ol.source.XYZ({
                        url: "https://mt1.google.com/vt/lyrs=s&x={x}&y={y}&z={z}",
                        attributions: '© <a href="https://maps.google.com">Google Maps</a>',
                        maxZoom: 22,
                        crossOrigin: "anonymous",
                    }),
                    visible: true,
                    preload: Infinity,
                })
                : new ol.layer.Tile({ source: new ol.source.OSM() });

            map = new ol.Map({
                target: "map",
                layers: [baseLayer],
                view: new ol.View({
                    projection: "EPSG:4326",
                    center: [110.364769, -7.801388],
                    zoom: 11
                })
            });

            addMapTypeControl();
            setupLayers(kalkelId);
            setupMapEventListeners();

            if (kalkelId) {
                loadKasultananData(kalkelId);
            } else {
                showAllBatasKalurahan();
                spinner.style.display = 'none';
            }

            window.addEventListener('resize', () => {
                if (map) setTimeout(() => map.updateSize(), 100);
            });
        }

        function addMapTypeControl() {
            const controlDiv = document.createElement('div');
            controlDiv.className = 'map-type-control-container';
            controlDiv.innerHTML = `
                <div class="map-type-header">
                    <span class="map-type-title">🗺️ Tampilan Peta</span>
                    <span class="map-type-arrow">▼</span>
                </div>
                <div class="map-type-options">
                    <div class="map-type-option ${currentMapType === 'osm' ? 'active' : ''}" data-type="osm">
                        <div class="option-icon">🗺️</div>
                        <div class="option-content">
                            <div class="option-title">Peta Standar</div>
                            <div class="option-desc">Tampilan peta jalan</div>
                        </div>
                        <div class="option-check">✓</div>
                    </div>
                    <div class="map-type-option ${currentMapType === 'imagery' ? 'active' : ''}" data-type="imagery">
                        <div class="option-icon">🛰️</div>
                        <div class="option-content">
                            <div class="option-title">Satelit</div>
                            <div class="option-desc">Citra satelit</div>
                        </div>
                        <div class="option-check">✓</div>
                    </div>
                </div>
            `;

            const header = controlDiv.querySelector('.map-type-header');
            const options = controlDiv.querySelector('.map-type-options');
            const arrow = controlDiv.querySelector('.map-type-arrow');

            header.addEventListener('click', () => {
                const isExpanded = options.style.display === 'block';
                options.style.display = isExpanded ? 'none' : 'block';
                arrow.textContent = isExpanded ? '▼' : '▲';
                controlDiv.classList.toggle('expanded', !isExpanded);
            });

            options.addEventListener('click', (e) => {
                const option = e.target.closest('.map-type-option');
                if (option) {
                    const newMapType = option.getAttribute('data-type');
                    if (newMapType !== currentMapType) {
                        changeMapType(newMapType);
                        options.querySelectorAll('.map-type-option').forEach(opt =>
                            opt.classList.remove('active')
                        );
                        option.classList.add('active');
                        const title = option.querySelector('.option-title').textContent;
                        controlDiv.querySelector('.map-type-title').textContent = `🗺️ ${title}`;
                        options.style.display = 'none';
                        arrow.textContent = '▼';
                        controlDiv.classList.remove('expanded');
                    }
                }
            });

            options.style.display = 'none';

            const customControl = new ol.control.Control({
                element: controlDiv
            });

            map.addControl(customControl);
        }

        function changeMapType(newMapType) {
            currentMapType = newMapType;
            map.getLayers().removeAt(0);

            const newBaseLayer = newMapType === 'imagery'
                ? new ol.layer.Tile({
                    source: new ol.source.XYZ({
                        url: "https://mt1.google.com/vt/lyrs=s&x={x}&y={y}&z={z}",
                        attributions: '© <a href="https://maps.google.com">Google Maps</a>',
                        maxZoom: 22,
                        crossOrigin: "anonymous",
                    }),
                    visible: true,
                    preload: Infinity,
                })
                : new ol.layer.Tile({ source: new ol.source.OSM() });

            map.getLayers().insertAt(0, newBaseLayer);
        }

        function setupLayers(kalkelId) {
            semuaBatasKalurahanVector = new ol.layer.Vector({
                source: new ol.source.Vector({
                    url: `https://geoserver.simtaka.id/geoserver/Simtaka/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=Simtaka:bataskal&outputFormat=application/json&srsname=EPSG:4326`,
                    format: new ol.format.GeoJSON()
                }),
                style: new ol.style.Style({
                    stroke: new ol.style.Stroke({ color: "red", width: 1 })
                })
            });

            batasKalurahanVector = new ol.layer.Vector({
                source: new ol.source.Vector({
                    url: kalkelId
                        ? `https://geoserver.simtaka.id/geoserver/Simtaka/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=Simtaka:bataskal&outputFormat=application/json&srsname=EPSG:4326&cql_filter=kalkel_id=${kalkelId}`
                        : '',
                    format: new ol.format.GeoJSON()
                }),
                style: new ol.style.Style({
                    stroke: new ol.style.Stroke({ color: "red", width: 3 }),
                    fill: new ol.style.Fill({ color: "rgba(0, 0, 255, 0.1)" })
                })
            });

            tanahKasultananVector = new ol.layer.Vector({
                source: new ol.source.Vector({
                    url: kalkelId
                        ? `https://geoserver.simtaka.id/geoserver/Simtaka/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=Simtaka:tanahkasultanan&outputFormat=application/json&srsname=EPSG:4326&cql_filter=kalkel_id=${kalkelId}`
                        : '',
                    format: new ol.format.GeoJSON()
                }),
                style: new ol.style.Style({
                    stroke: new ol.style.Stroke({ color: "yellow", width: 1 }),
                    fill: new ol.style.Fill({ color: "rgba(245, 158, 11, 0.4)" })
                })
            });

            // HIGHLIGHT LAYER - GARIS KUNING TERANG
            highlightLayer = new ol.layer.Vector({
                source: new ol.source.Vector(),
                style: new ol.style.Style({
                    stroke: new ol.style.Stroke({
                        color: "#FFEB3B", // KUNING NEON TERANG
                        width: 5, // Lebih tebal
                        lineDash: [15, 8] // Garis putus-putus lebih panjang
                    }),
                    fill: new ol.style.Fill({
                        color: "rgba(255, 235, 59, 0.15)" // Sedikit transparan kuning neon
                    })
                })
            });

            map.addLayer(semuaBatasKalurahanVector);
            map.addLayer(tanahKasultananVector);
            map.addLayer(batasKalurahanVector);
            map.addLayer(highlightLayer);
        }

        function showAllBatasKalurahan() {
            semuaBatasKalurahanVector.getSource().on('change', function() {
                const features = this.getFeatures();
                if (features.length > 0) {
                    const extent = ol.extent.createEmpty();
                    features.forEach(f => ol.extent.extend(extent, f.getGeometry().getExtent()));
                    map.getView().fit(extent, { padding: [50, 50, 50, 50], duration: 1000 });
                }
                document.getElementById('loading-spinner').style.display = 'none';
            });

            semuaBatasKalurahanVector.getSource().on('error', function(error) {
                console.error("Error loading semua batas kalurahan:", error);
                document.getElementById('loading-spinner').style.display = 'none';
            });
        }

        function setupMapEventListeners() {
            map.on("singleclick", function(evt) {
                const feature = map.forEachFeatureAtPixel(evt.pixel, function(feature, layer) {
                    return layer === tanahKasultananVector ? feature : null;
                });

                if (feature) {
                    updateHighlight(feature);
                    const center = ol.extent.getCenter(feature.getGeometry().getExtent());
                    map.getView().animate({ center: center, duration: 500 });
                }
            });

            map.on('loadend', function() {
                document.getElementById('loading-spinner').style.display = 'none';
            });

            map.getViewport().addEventListener('click', (e) => {
                const control = document.querySelector('.map-type-control-container');
                if (control && !control.contains(e.target)) {
                    const options = control.querySelector('.map-type-options');
                    const arrow = control.querySelector('.map-type-arrow');
                    options.style.display = 'none';
                    arrow.textContent = '▼';
                    control.classList.remove('expanded');
                }
            });
        }

        function updateHighlight(feature) {
            if (!highlightLayer) return;

            highlightLayer.getSource().clear();
            document.querySelectorAll('#data-table tr').forEach(row => {
                row.classList.remove('highlighted-row');
            });

            // Reset semua bidang ke style semula
            if (currentlyHighlightedFeature) {
                currentlyHighlightedFeature.setStyle(null); // Kembalikan ke style default layer
            }

            if (feature) {
                // Simpan feature yang sedang di-highlight
                currentlyHighlightedFeature = feature;

                // Buat bidang yang diklik menjadi TRANSPARAN
                feature.setStyle(new ol.style.Style({
                    stroke: new ol.style.Stroke({
                        color: "rgba(0, 0, 0, 0)",
                        width: 0
                    }),
                    fill: new ol.style.Fill({
                        color: "rgba(0, 0, 0, 0)"
                    })
                }));

                // BUAT FEATURE BARU UNTUK HIGHLIGHT DENGAN GEOMETRY YANG SAMA
                const geometry = feature.getGeometry();
                const highlightFeature = new ol.Feature({
                    geometry: geometry
                });

                highlightLayer.getSource().addFeature(highlightFeature);

                const tableRow = document.querySelector(`tr[data-feature-id="${feature.getId()}"]`);
                if (tableRow) {
                    tableRow.classList.add('highlighted-row');
                    tableRow.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }

                // Zoom ke bidang yang dipilih
                const center = ol.extent.getCenter(feature.getGeometry().getExtent());
                map.getView().animate({ center: center, duration: 500 });
            } else {
                currentlyHighlightedFeature = null;
            }
        }

        function loadKasultananData(kalkelId) {
            const spinner = document.getElementById('loading-spinner');
            const tableSpinner = document.getElementById("loading-table-spinner");
            const noDataMessage = document.getElementById("no-data-message");
            const locationHeader = document.getElementById("location-header");

            tableSpinner.style.display = 'block';
            noDataMessage.style.display = 'none';

            let batasLoaded = false;
            let tanahLoaded = false;

            function checkAllLoaded() {
                if (batasLoaded && tanahLoaded) {
                    spinner.style.display = 'none';
                    tableSpinner.style.display = 'none';
                }
            }

            batasKalurahanVector.getSource().on('change', function() {
                const features = this.getFeatures();
                if (features.length > 0) {
                    const extent = ol.extent.createEmpty();
                    features.forEach(f => ol.extent.extend(extent, f.getGeometry().getExtent()));
                    map.getView().fit(extent, { padding: [50, 50, 50, 50], duration: 1000 });

                    const props = features[0].getProperties();
                    locationHeader.innerHTML = `
                        Kalurahan: ${props.wadmkd || '-'}<br>
                        Kapanewon: ${props.wadmkc || '-'}<br>
                        Kabupaten: ${props.wadmkk || '-'}
                    `;
                } else {
                    noDataMessage.style.display = 'block';
                    noDataMessage.textContent = 'Tidak ada batas kalurahan yang ditemukan.';
                }
                batasLoaded = true;
                checkAllLoaded();
            });

            tanahKasultananVector.getSource().on('change', function() {
                const features = this.getFeatures();
                updateTable(features);
                tanahLoaded = true;
                checkAllLoaded();
            });

            batasKalurahanVector.getSource().on('error', function() {
                noDataMessage.style.display = 'block';
                noDataMessage.textContent = 'Error memuat batas kalurahan.';
                batasLoaded = true;
                checkAllLoaded();
            });

            tanahKasultananVector.getSource().on('error', function() {
                noDataMessage.style.display = 'block';
                noDataMessage.textContent = 'Error memuat data tanah.';
                tanahLoaded = true;
                checkAllLoaded();
            });

            setTimeout(() => {
                if (!batasLoaded || !tanahLoaded) {
                    spinner.style.display = 'none';
                    tableSpinner.style.display = 'none';
                    noDataMessage.style.display = 'block';
                    noDataMessage.textContent = 'Timeout memuat data. Silakan refresh.';
                }
            }, 15000);
        }

        function updateTable(features) {
            const dataTable = document.getElementById("data-table");
            const noDataMessage = document.getElementById("no-data-message");
            const tableBody = dataTable.querySelector('tbody');

            tableBody.innerHTML = '';

            if (features.length > 0) {
                features.sort((a, b) => {
                    const valA = parseFloat(a.get('luas_persi')) || 0;
                    const valB = parseFloat(b.get('luas_persi')) || 0;
                    return valB - valA;
                });

                features.forEach((feature, index) => {
                    const props = feature.getProperties();
                    const geometry = feature.getGeometry();
                    const center = ol.extent.getCenter(geometry.getExtent());
                    const [lon, lat] = center;
                    const googleMapsUrl = `https://www.google.com/maps/place/${lat},${lon}`;

                    const row = document.createElement('tr');
                    row.setAttribute('data-feature-id', feature.getId());
                    row.innerHTML = `
                        <td>${index + 1}</td>
                        <td>${props.keterangan || "-"}</td>
                        <td>${props.luas_persi ? parseFloat(props.luas_persi).toFixed(0) + ' m²' : "-"}</td>
                        <td>
                            <a href="${googleMapsUrl}" target="_blank" class="gmaps-link">
                                <img src="/images/gmaps.png" alt="Google Maps" style="width:24px;height:24px;">
                            </a>
                        </td>
                    `;

                    row.addEventListener('click', function() {
                        updateHighlight(feature);
                        const center = ol.extent.getCenter(feature.getGeometry().getExtent());
                        map.getView().animate({ center: center, duration: 500 });
                    });

                    tableBody.appendChild(row);
                });

                dataTable.style.display = 'table';
                noDataMessage.style.display = 'none';
            } else {
                dataTable.style.display = 'none';
                noDataMessage.style.display = 'block';
                noDataMessage.textContent = 'Tidak ada data bidang tanah di kalurahan ini.';
            }
        }

        function setupSorting() {
            const sortLuasHeader = document.getElementById("sort-luas");
            if (sortLuasHeader) {
                let isSortedAsc = false;

                sortLuasHeader.addEventListener("click", function() {
                    const dataTable = document.getElementById("data-table");
                    const tableBody = dataTable.querySelector("tbody");
                    const rows = Array.from(tableBody.querySelectorAll("tr"));

                    if (rows.length === 0) return;

                    isSortedAsc = !isSortedAsc;

                    rows.sort((a, b) => {
                        const valA = parseFloat(a.cells[2].textContent) || 0;
                        const valB = parseFloat(b.cells[2].textContent) || 0;
                        return isSortedAsc ? valA - valB : valB - valA;
                    });

                    tableBody.innerHTML = "";
                    rows.forEach((row, index) => {
                        row.cells[0].textContent = index + 1;
                        tableBody.appendChild(row);
                    });

                    sortLuasHeader.setAttribute("data-sort-order", isSortedAsc ? "asc" : "desc");
                });
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const kalkelId = @json($kalkel_id);
            setTimeout(() => {
                initializeMap(kalkelId);
                setupSorting();
            }, 100);
        });

        document.addEventListener('livewire:navigated', function() {
            const kalkelId = @json($kalkel_id);
            if (kalkelId !== currentKalkelId) {
                setTimeout(() => {
                    initializeMap(kalkelId);
                }, 100);
            }
        });
    </script>
    @endpush

    @push('styles')
    <style>
        .peta-kasultanan-container {
            position: relative;
            height: 100%;
        }

        .map-container-wrapper {
            height: calc(100vh - 100px);
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .map-element {
            flex: 1;
            height: 60%;
            min-height: 300px;
            position: relative;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            overflow: hidden;
        }

        .data-container {
            width: 100%;
            height: 40%;
            display: flex;
            flex-direction: column;
            padding: 16px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            background: white;
        }

        .location-header {
            font-size: 16px;
            margin-top: 0;
            padding-bottom: 12px;
            font-weight: bold;
            color: #374151;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 16px;
        }

        .scrollable-table-container {
            flex-grow: 1;
            overflow-y: auto;
            position: relative;
        }

        .loading-spinner-container {
            display: none;
            text-align: center;
            padding: 20px;
        }

        .spinner {
            width: 24px;
            height: 24px;
            border: 3px solid #007bff;
            border-color: #007bff transparent #007bff transparent;
            border-radius: 50%;
            animation: lds-dual-ring 1.2s linear infinite;
            display: inline-block;
        }

        .data-table-style {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            display: none;
        }

        .data-table-style th, .data-table-style td {
            padding: 12px;
            border: 1px solid #e5e7eb;
            text-align: left;
        }

        .data-table-style thead {
            background-color: #f3f4f6;
            position: sticky;
            top: 0;
        }

        .data-table-style tbody tr:hover {
            background-color: #f9fafb;
            cursor: pointer;
        }

        .no-data-message {
            display: none;
            padding: 20px;
            text-align: center;
            color: #6b7280;
            font-style: italic;
        }

        .full-page-loading-spinner {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: none;
            z-index: 1000;
        }

        .full-page-loading-spinner::after {
            content: " ";
            display: block;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 4px solid #007bff;
            border-color: #007bff transparent #007bff transparent;
            animation: lds-dual-ring 1.2s linear infinite;
        }

        @keyframes lds-dual-ring {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .highlighted-row {
            background-color: #e0eaff !important;
        }

        .gmaps-link {
            display: inline-block;
            transition: transform 0.2s ease;
        }

        .gmaps-link:hover {
            transform: scale(1.1);
        }

        #sort-luas {
            cursor: pointer;
            user-select: none;
        }

        #sort-luas .sort-indicator::after {
            margin-left: 8px;
            font-size: 12px;
        }

        #sort-luas[data-sort-order="desc"] .sort-indicator::after {
            content: "▼";
        }

        #sort-luas[data-sort-order="asc"] .sort-indicator::after {
            content: "▲";
        }

        .map-type-control-container {
            position: absolute;
            top: 10px;
            left: 10px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            border: 1px solid #e1e5e9;
            min-width: 200px;
            z-index: 1000;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .map-type-control-container.expanded {
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        }

        .map-type-header {
            padding: 12px 16px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-weight: 600;
            transition: background 0.3s ease;
        }

        .map-type-header:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        }

        .map-type-title {
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .map-type-arrow {
            font-size: 12px;
            transition: transform 0.3s ease;
        }

        .map-type-options {
            background: white;
            border-top: 1px solid #f1f3f4;
            display: none;
        }

        .map-type-option {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            cursor: pointer;
            border-bottom: 1px solid #f8f9fa;
            transition: all 0.2s ease;
            position: relative;
        }

        .map-type-option:last-child {
            border-bottom: none;
        }

        .map-type-option:hover {
            background: #f8f9fa;
            transform: translateX(2px);
        }

        .map-type-option.active {
            background: #e3f2fd;
            border-left: 3px solid #2196f3;
        }

        .option-icon {
            font-size: 20px;
            margin-right: 12px;
            width: 24px;
            text-align: center;
        }

        .option-content {
            flex: 1;
        }

        .option-title {
            font-weight: 600;
            font-size: 14px;
            color: #1a1a1a;
            margin-bottom: 2px;
        }

        .option-desc {
            font-size: 12px;
            color: #666;
        }

        .option-check {
            color: #2196f3;
            font-weight: bold;
            font-size: 16px;
            opacity: 0;
            transition: opacity 0.2s ease;
        }

        .map-type-option.active .option-check {
            opacity: 1;
        }

        @media (min-width: 1024px) {
            .map-container-wrapper {
                flex-direction: row;
            }
            .map-element {
                height: 100%;
                flex: 3;
            }
            .data-container {
                width: 30%;
                height: 100%;
                flex: 1;
            }
            .map-type-control-container {
                min-width: 220px;
            }
        }

        @media (max-width: 768px) {
            .map-container-wrapper {
                height: calc(100vh - 140px);
            }
            .data-table-style {
                font-size: 12px;
            }
            .data-table-style th,
            .data-table-style td {
                padding: 8px;
            }
            .map-type-control-container {
                min-width: 180px;
                left: 5px;
                top: 5px;
            }
            .map-type-header {
                padding: 10px 12px;
            }
            .map-type-option {
                padding: 10px 12px;
            }
            .option-title {
                font-size: 13px;
            }
            .option-desc {
                font-size: 11px;
            }
        }
    </style>
    @endpush
</x-filament-panels::page>
