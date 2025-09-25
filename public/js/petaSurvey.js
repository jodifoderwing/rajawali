// Inisialisasi Peta
const map = new ol.Map({
    target: "map",
    layers: [
        new ol.layer.Tile({
            source: new ol.source.OSM(),
        }),
    ],
    view: new ol.View({
        projection: "EPSG:4326",
        center: [110.364769, -7.801388], // Titik Nol Jogja
        zoom: 11,
    }),
});

// Layer Batas Desa (WMS) untuk tampilan umum
const batasDesaWMS = new ol.layer.Tile({
    title: "Batas Wilayah Administrasi DIY",
    source: new ol.source.TileWMS({
        // url: "http://localhost:8080/geoserver/BatasAdmDiy/wms",
        url: "http://localhost:8080/geoserver/Simtaka/wms",
        params: {
            LAYERS: "Simtaka:BatasKal",
            // STYLES: "batasdesa_outline_glow", // style outline glow
            STYLES: "batasdesa_outline", // style outline
            TILED: true,
            CRS: "EPSG:4326",
            VERSION: "1.1.1",
        },
        serverType: "geoserver",
        crossOrigin: "anonymous",
    }),
});
map.addLayer(batasDesaWMS);

// Layer highlight (kosong dulu)
const highlightLayer = new ol.layer.Vector({
    source: new ol.source.Vector(),
    style: new ol.style.Style({
        stroke: new ol.style.Stroke({
            color: "blue",
            width: 5, // lebih tebal saat diklik
        }),
        fill: new ol.style.Fill({
            color: "rgba(0,0,0,0)", // transparan
        }),
    }),
});
map.addLayer(highlightLayer);

// Handle klik untuk Info + Highlight
map.on("singleclick", function (evt) {
    const viewResolution = map.getView().getResolution();
    const source = batasDesaWMS.getSource();

    const url = source.getFeatureInfoUrl(
        evt.coordinate,
        viewResolution,
        "EPSG:4326",
        { INFO_FORMAT: "application/json" }
    );

    if (url) {
        fetch(url)
            .then((response) => response.json())
            .then((data) => {
                const popup = document.getElementById("popup");
                if (data.features.length > 0) {
                    const feature = data.features[0];
                    const props = feature.properties;

                    // Ambil langsung dari GeoServer, format 2 angka di belakang koma
                    const luasHa = props.luaswh
                        ? parseFloat(props.luaswh).toFixed(2)
                        : "-";

                    // Tampilkan popup info
                    popup.innerHTML = `
                        <b>Kalurahan:</b> ${props.wadmkd || "-"}<br>
                        <b>Kapanewon:</b> ${props.wadmkc || "-"}<br>
                        <b>Kabupaten:</b> ${props.wadmkk || "-"}<br>
                        <b>Provinsi:</b> ${props.wadmpr || "-"}<br>
                        <b>Luas:</b> ${luasHa} Ha
                    `;
                    popup.style.display = "block";
                    popup.style.left = evt.pixel[0] + "px";
                    popup.style.top = evt.pixel[1] + "px";

                    // Hapus highlight lama
                    highlightLayer.getSource().clear();

                    // Tambahkan highlight baru dari GeoJSON feature
                    const format = new ol.format.GeoJSON();
                    const highlighted = format.readFeature(feature, {
                        dataProjection: "EPSG:4326",
                        featureProjection: map.getView().getProjection(),
                    });
                    highlightLayer.getSource().addFeature(highlighted);
                }
            });
    }
});

// Tutup popup saat peta digerakkan
map.on("movestart", function () {
    document.getElementById("popup").style.display = "none";
    highlightLayer.getSource().clear(); // hapus highlight kalau geser peta
});
