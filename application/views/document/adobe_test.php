<style>
    div.floating-container {
        position: absolute;
        top: 8px;
        left: 0;
        width: 100vw;
        height: 46px;
        z-index: 10000;
        pointer-events: none;

        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    div.floating-container button {
        pointer-events: auto;
    }
</style>

<div class="floating-container">
    <button type="button" id="btnDumpAnnotations">Dump Annotations</button>
    <button type="button" id="btnDumpMetadata">Dump Metadata</button>
</div>

<div id="adobe-dc-view"></div>
<script src="https://documentcloud.adobe.com/view-sdk/main.js"></script>
<script type="text/javascript">
const viewerConfig = {
    enableAnnotationAPIs: true,
    includePDFAnnotations: true,
    showDisabledSaveButton: true,
    showDownloadPDF: true,
    showPrintPDF: false,
    showPageControls: false,
    showLeftHandPanel: false,
};

document.addEventListener("adobe_dc_view_sdk.ready", function() {
    var adobeDCView = new AdobeDC.View({
        clientId: "6180e330363c422083ac32a257227163",
        divId: "adobe-dc-view",
    });
    var previewFilePromise = adobeDCView.previewFile({
        content: {
            location: {
                url: "<?= $url ?>",
            }
        },
        metaData: {
            fileName: "<?= $filename ?>",
            id: "32fabe28-0cf0-4fad-a84e-7aa45cbbd589",
        },
    }, viewerConfig);

    adobeDCView.registerCallback(
        AdobeDC.View.Enum.CallbackType.SAVE_API,
        function (metaData, content, options) {
            var uint8Array = new Uint8Array(content);
            var blob = new Blob([uint8Array], { type: 'application/pdf' });
            formData = new FormData();
            formData.append('pdfFile', blob, "<?= $filename ?>");

            fetch("<?= site_url("document/adobe_test/true") ?>", {
                method: 'POST',
                body: formData,
            }).then(async response => {
                const text = await response.text();
                if (text === "UPLOADED") {
                    window.location.reload();
                } else {
                    alert(text);
                }
            }).catch(console.error);

            return new Promise((resolve, reject) => {
                resolve({
                    code: AdobeDC.View.Enum.ApiResponseCode.SUCCESS,
                    data: {
                        metaData: { fileName: "<?= $filename ?>" },
                    },
                });
            });
        }, {
            autoSaveFrequency: 0,
            enableFocusPolling: false,
        }
    );

    previewFilePromise.then(adobeViewer => {
        document.getElementById("btnDumpAnnotations").onclick = event => {
            event.preventDefault();
            adobeViewer.getAnnotationManager().then(annotationManager => {
                annotationManager.getAnnotations()
                    .then (result => console.log(result))
                    .catch(error => console.log(error));
            });
        };

        document.getElementById("btnDumpMetadata").onclick = event => {
            event.preventDefault();
            adobeViewer.getAPIs().then(apis => {
                apis.getXMPMetadata(undefined, true)
                    .then (result => console.log(result))
                    .catch(error => console.log(error));
            });
        };
    });
});
</script>