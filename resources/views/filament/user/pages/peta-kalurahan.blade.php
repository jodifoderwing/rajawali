<x-filament-panels::page>
    <div class="map-container-wrapper">
        <div id="map" class="map-element"></div>

        <div id="data-container" class="data-container">
            <p id="location-header" class="location-header"></p>

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
                    Pilih kalurahan untuk menampilkan data.
                </div>
            </div>
        </div>
    </div>

    <div id="loading-spinner" class="full-page-loading-spinner"></div>

    <script src="https://cdn.jsdelivr.net/npm/ol@v9.2.4/dist/ol.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ol@v9.2.4/ol.css">

    <script>
        // Variabel global untuk menyimpan state
        let map = null;
        let batasKalurahanVector = null;
        let semuaBatasKalurahanVector = null; // Layer baru untuk semua batas kalurahan
        let tanahKalurahanVector = null;
        let highlightLayer = null;
        let isSortedAsc = false;
        let currentKalkelId = null;

        // Fungsi utama untuk inisialisasi peta
        function initializeMap(kalkelId) {
            console.log("Initializing map with kalkelId:", kalkelId);

            const spinner = document.getElementById('loading-spinner');
            const tableSpinner = document.getElementById("loading-table-spinner");
            const dataTable = document.getElementById("data-table");
            const noDataMessage = document.getElementById("no-data-message");
            const locationHeader = document.getElementById("location-header");

            // Reset state
            locationHeader.innerHTML = '';
            currentKalkelId = kalkelId;

            // Hapus peta lama jika ada
            if (map) {
                map.setTarget(null);
                map = null;
            }

            // Buat elemen peta baru
            const mapElement = document.getElementById('map');
            mapElement.innerHTML = '';
            mapElement.style.width = '100%';
            mapElement.style.height = '100%';

            // Inisialisasi peta OpenLayers
            map = new ol.Map({
                target: "map",
                layers: [new ol.layer.Tile({ source: new ol.source.OSM() })],
                view: new ol.View({
                    projection: "EPSG:4326",
                    center: [110.364769, -7.801388],
                    zoom: 11
                }),
            });

            // Setup layers
            setupLayers(kalkelId);

            // Setup event listeners
            setupMapEventListeners();

            // Load data jika kalkelId tersedia
            if (kalkelId) {
                loadData(kalkelId, spinner, tableSpinner, noDataMessage, dataTable, locationHeader);
            } else {
                noDataMessage.style.display = 'block';
                dataTable.style.display = 'none';
                // Tampilkan semua batas kalurahan jika tidak ada kalurahan terpilih
                showAllBatasKalurahan();
            }

            // Handle resize
            window.addEventListener('resize', function() {
                if (map) {
                    setTimeout(() => {
                        map.updateSize();
                    }, 100);
                }
            });
        }

        function setupLayers(kalkelId) {
            // Layer untuk SEMUA batas kalurahan (warna merah tipis)
            semuaBatasKalurahanVector = new ol.layer.Vector({
                source: new ol.source.Vector({
                    format: new ol.format.GeoJSON(),
                    url: function() {
                        const urlParams = new URLSearchParams({
                            service: 'WFS',
                            version: '1.0.0',
                            request: 'GetFeature',
                            typeName: 'Simtaka:bataskal',
                            outputFormat: 'application/json',
                            srsname: 'EPSG:4326'
                        });
                        return `https://geoserver.simtaka.id/geoserver/Simtaka/ows?${urlParams.toString()}`;
                    },
                }),
                style: new ol.style.Style({
                    stroke: new ol.style.Stroke({ color: "red", width: 1 }), // Merah tipis
                    // fill: new ol.style.Fill({ color: "rgba(255, 0, 0, 0.1)" }),
                }),
            });

            // Layer untuk batas kalurahan terpilih (warna biru tebal)
            batasKalurahanVector = new ol.layer.Vector({
                source: new ol.source.Vector({
                    format: new ol.format.GeoJSON(),
                    url: function() {
                        const urlParams = new URLSearchParams({
                            service: 'WFS',
                            version: '1.0.0',
                            request: 'GetFeature',
                            typeName: 'Simtaka:bataskal',
                            outputFormat: 'application/json',
                            srsname: 'EPSG:4326',
                            cql_filter: kalkelId ? `kalkel_id=${kalkelId}` : '1=0',
                        });
                        return `https://geoserver.simtaka.id/geoserver/Simtaka/ows?${urlParams.toString()}`;
                    },
                }),
                style: new ol.style.Style({
                    stroke: new ol.style.Stroke({ color: "blue", width: 3 }), // Biru tebal
                    fill: new ol.style.Fill({ color: "rgba(0, 0, 255, 0.1)" }),
                }),
            });

            // Tanah Kalurahan Layer
            tanahKalurahanVector = new ol.layer.Vector({
                source: new ol.source.Vector({
                    format: new ol.format.GeoJSON(),
                    url: function() {
                        const urlParams = new URLSearchParams({
                            service: 'WFS',
                            version: '1.0.0',
                            request: 'GetFeature',
                            typeName: 'Simtaka:tanahkalurahan',
                            outputFormat: 'application/json',
                            srsname: 'EPSG:4326',
                            cql_filter: kalkelId ? `kalkel_id=${kalkelId}` : '1=0',
                        });
                        return `https://geoserver.simtaka.id/geoserver/Simtaka/ows?${urlParams.toString()}`;
                    },
                }),
                style: new ol.style.Style({
                    stroke: new ol.style.Stroke({ color: "#2E8B57", width: 2 }),
                    fill: new ol.style.Fill({ color: "rgba(46, 139, 87, 0.4)" }),
                }),
            });

            // Highlight Layer
            highlightLayer = new ol.layer.Vector({
                source: new ol.source.Vector(),
                style: new ol.style.Style({
                    stroke: new ol.style.Stroke({ color: "yellow", width: 5 }),
                    fill: new ol.style.Fill({ color: "rgba(255, 255, 0, 0.2)" }),
                }),
            });

            // Tambahkan layers ke peta - SEMUA batas kalurahan ditambahkan pertama
            map.addLayer(semuaBatasKalurahanVector);
            map.addLayer(tanahKalurahanVector);
            map.addLayer(batasKalurahanVector);
            map.addLayer(highlightLayer);
        }

        function showAllBatasKalurahan() {
            // Fit view untuk menampilkan semua batas kalurahan
            semuaBatasKalurahanVector.getSource().once('featuresloadend', function(event) {
                if (event.features.length > 0) {
                    const extent = ol.extent.createEmpty();
                    event.features.forEach(f => {
                        ol.extent.extend(extent, f.getGeometry().getExtent());
                    });

                    // Fit view dengan padding
                    map.getView().fit(extent, { padding: [50, 50, 50, 50], duration: 1000 });
                }
            });
        }

        function setupMapEventListeners() {
            // Event listener untuk klik pada peta
            map.on("singleclick", function(evt) {
                const feature = map.forEachFeatureAtPixel(evt.pixel, function (feature, layer) {
                    if (layer === tanahKalurahanVector) {
                        return feature;
                    }
                    return null;
                });

                updateHighlight(feature);

                if (feature) {
                    const center = ol.extent.getCenter(feature.getGeometry().getExtent());
                    map.getView().animate({
                        center: center,
                        duration: 500
                    });
                }
            });
        }

        function loadData(kalkelId, spinner, tableSpinner, noDataMessage, dataTable, locationHeader) {
            spinner.style.display = 'block';
            tableSpinner.style.display = 'block';
            noDataMessage.style.display = 'none';
            dataTable.style.display = 'none';

            // Load batas kalurahan terpilih
            batasKalurahanVector.getSource().once('featuresloadend', function(event) {
                spinner.style.display = 'none';
                if (event.features.length > 0) {
                    const extent = ol.extent.createEmpty();
                    event.features.forEach(f => {
                        ol.extent.extend(extent, f.getGeometry().getExtent());
                    });

                    // Fit view dengan padding
                    map.getView().fit(extent, { padding: [50, 50, 50, 50], duration: 1000 });

                    const props = event.features[0].getProperties();
                    locationHeader.innerHTML = `
                        Kalurahan: ${props.wadmkd || '-'},<br>
                        Kapanewon: ${props.wadmkc || '-'},<br>
                        Kabupaten: ${props.wadmkk || '-'}
                    `;
                } else {
                    noDataMessage.style.display = 'block';
                    noDataMessage.innerText = 'Tidak ada batas kalurahan yang ditemukan.';
                }
            });

            // Load tanah kalurahan
            tanahKalurahanVector.getSource().once('featuresloadend', function(event) {
                tableSpinner.style.display = 'none';
                updateTable(event.features);
            });
        }

        function updateHighlight(feature) {
            if (!highlightLayer) return;

            highlightLayer.getSource().clear();
            document.querySelectorAll('#data-table tr').forEach(row => {
                row.classList.remove('highlighted-row');
            });

            if (feature) {
                highlightLayer.getSource().addFeature(feature);
                const featureId = feature.getId();
                const tableRow = document.querySelector(`tr[data-feature-id="${featureId}"]`);

                if (tableRow) {
                    tableRow.classList.add('highlighted-row');
                    if (!isElementInViewport(tableRow)) {
                        tableRow.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                }
            }
        }

        function isElementInViewport(el) {
            if (!el) return false;
            const rect = el.getBoundingClientRect();
            return (
                rect.top >= 0 &&
                rect.left >= 0 &&
                rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
                rect.right <= (window.innerWidth || document.documentElement.clientHeight)
            );
        }

        function updateTable(features) {
            const dataTable = document.getElementById("data-table");
            const noDataMessage = document.getElementById("no-data-message");
            const tableBody = dataTable.querySelector('tbody');
            tableBody.innerHTML = '';
            updateHighlight(null);

            // Reset status sorting saat data baru dimuat
            isSortedAsc = false;
            const sortLuasHeader = document.getElementById("sort-luas");
            if (sortLuasHeader) {
                sortLuasHeader.setAttribute("data-sort-order", "desc");
            }

            if (features.length > 0) {
                // Sort default dari yang terbesar ke terkecil
                features.sort((a, b) => {
                    const valA = parseFloat(a.getProperties().luas_persi) || 0;
                    const valB = parseFloat(b.getProperties().luas_persi) || 0;
                    return valB - valA;
                });

                let i = 1;
                features.forEach(feature => {
                    const props = feature.getProperties();
                    const geometry = feature.getGeometry();
                    const center = ol.extent.getCenter(geometry.getExtent());
                    const [lon, lat] = center;

                    const googleMapsUrl = `https://www.google.com/maps/place/${lat},${lon}/@${lat},${lon},18z`;

                    const row = `
                        <tr data-feature-id="${feature.getId()}">
                            <td>${i++}</td>
                            <td>${props.keterangan || "-"}</td>
                            <td>${props.luas_persi ? parseFloat(props.luas_persi).toFixed(0) : "-"}</td>
                            <td>
                                <a href="${googleMapsUrl}" target="_blank" >
                                    <img src="/images/gmaps.png" alt="logo" style="width:24px;height:24px;">
                                </a>
                            </td>
                        </tr>
                    `;
                    tableBody.insertAdjacentHTML('beforeend', row);
                });

                dataTable.style.display = 'table';
                noDataMessage.style.display = 'none';

                // Pasang event listener untuk baris tabel
                attachTableRowListeners();
            } else {
                dataTable.style.display = 'none';
                noDataMessage.style.display = 'block';
                noDataMessage.innerText = 'Tidak ada data bidang tanah di kalurahan ini.';
            }
        }

        function attachTableRowListeners() {
            const dataTable = document.getElementById("data-table");

            // Hapus event listener lama jika ada
            const newTable = dataTable.cloneNode(true);
            dataTable.parentNode.replaceChild(newTable, dataTable);

            // Pasang event listener baru
            newTable.addEventListener('click', function(evt) {
                const clickedRow = evt.target.closest('tr[data-feature-id]');
                if (clickedRow && tanahKalurahanVector) {
                    const featureId = clickedRow.getAttribute('data-feature-id');
                    const feature = tanahKalurahanVector.getSource().getFeatureById(featureId);
                    updateHighlight(feature);

                    if (feature) {
                        const center = ol.extent.getCenter(feature.getGeometry().getExtent());
                        map.getView().animate({
                            center: center,
                            duration: 500
                        });
                    }
                }
            });
        }

        // Inisialisasi setelah DOM selesai dimuat
        document.addEventListener('DOMContentLoaded', function() {
            const kalkelId = @json($kalkel_id);
            console.log("DOM loaded, kalkelId:", kalkelId);

            // Inisialisasi peta
            initializeMap(kalkelId);

            // Pasang event listener untuk sorting
            const sortLuasHeader = document.getElementById("sort-luas");
            if (sortLuasHeader) {
                sortLuasHeader.addEventListener("click", function() {
                    const dataTable = document.getElementById("data-table");
                    const tableBody = dataTable.querySelector("tbody");
                    const rows = Array.from(tableBody.querySelectorAll("tr"));

                    // Toggle status sorting
                    isSortedAsc = !isSortedAsc;

                    rows.sort((a, b) => {
                        const valA = parseFloat(a.cells[2].textContent) || 0;
                        const valB = parseFloat(b.cells[2].textContent) || 0;

                        if (isSortedAsc) {
                            return valA - valB; // Kecil ke Besar
                        } else {
                            return valB - valA; // Besar ke Kecil
                        }
                    });

                    // Hapus semua baris dan tambahkan yang sudah diurutkan
                    tableBody.innerHTML = "";
                    rows.forEach((row, index) => {
                        // Update nomor urut
                        row.cells[0].textContent = index + 1;
                        tableBody.appendChild(row);
                    });

                    // Update indikator urutan
                    if (isSortedAsc) {
                        sortLuasHeader.setAttribute("data-sort-order", "asc");
                    } else {
                        sortLuasHeader.setAttribute("data-sort-order", "desc");
                    }
                });
            }
        });

        // Handle navigasi Livewire
        document.addEventListener('livewire:navigated', function() {
            console.log("Livewire navigated");
            const kalkelId = @json($kalkel_id);
            if (kalkelId !== currentKalkelId) {
                initializeMap(kalkelId);
            }
        });

        // Handle initial Livewire load
        document.addEventListener('livewire:init', function() {
            console.log("Livewire initialized");
            const kalkelId = @json($kalkel_id);
            initializeMap(kalkelId);
        });
    </script>

    <style>
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
            padding-top: 4px;
            padding-bottom: 12px;
            font-weight: bold;
            color: #374151;
        }

        .scrollable-table-container {
            flex-grow: 1;
            overflow-y: auto;
            position: relative;
        }

        .loading-spinner-container {
            display: none;
            text-align: center;
        }

        .loading-spinner-container p {
            margin-top: 8px;
            color: #6b7280;
        }

        .spinner {
            width: 20px;
            height: 20px;
            border: 2px solid #007bff;
            border-color: #007bff transparent #007bff transparent;
            border-radius: 50%;
            display: inline-block;
            animation: lds-dual-ring 1.2s linear infinite;
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
            z-index: 10;
        }

        .no-data-message {
            display: none;
            padding: 8px;
            text-align: center;
            color: #6b7280;
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
            background-color: #e0eaff;
            transition: background-color 0.3s ease;
        }

        /* CSS untuk kursor */
        #map {
            cursor: grab;
        }

        #map.ol-grabbing {
            cursor: grabbing;
        }

        #data-table tbody tr {
            cursor: pointer;
        }

        #sort-luas {
            cursor: pointer;
        }

        #sort-luas .sort-indicator::after {
            content: " ";
            margin-left: 8px;
            font-size: 12px;
        }

        #sort-luas[data-sort-order="desc"] .sort-indicator::after {
            content: "▼";
        }

        #sort-luas[data-sort-order="asc"] .sort-indicator::after {
            content: "▲";
        }

        /* Responsive styles */
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
        }
    </style>
</x-filament-panels::page>
