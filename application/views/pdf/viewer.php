<div id="adobe-dc-view"></div>
<script src="https://documentcloud.adobe.com/view-sdk/viewer.js?ver=<?= rand(1, 999999999) ?>"></script>
<script type="text/javascript">
const viewerConfig = {
    enableAnnotationAPIs: true,
    includePDFAnnotations: true,
    showDisabledSaveButton: true,
};

document.addEventListener("adobe_dc_view_sdk.ready", function() {
    var adobeDCView = new AdobeDC.View({
        clientId: "e9103ee23ff2428599d4ace4d17e493f",
        divId: "adobe-dc-view",
    });
    var previewFilePromise = adobeDCView.previewFile({
        content: {
            location: {
                url: "<?= $file ?>?ver=<?= rand(1, 999999999) ?>",
            }
        },
        metaData: {
            fileName: "<?= $doc["NAME"] ?>.pdf",
            id: "6d07d124-ac85-43b3-a867-36930f502ac6",
        },
    }, viewerConfig);

    adobeDCView.registerCallback(
        AdobeDC.View.Enum.CallbackType.GET_USER_PROFILE_API,
        function() {
            return new Promise((resolve, reject) => {
                resolve({
                    code: AdobeDC.View.Enum.ApiResponseCode.SUCCESS,
                    data: {
                        userProfile: {
                            name: "<?= $this->session->userdata("name") ?>",
                            email: "<?= $this->session->userdata("mail") ?>",
                        },
                    },
                });
            });
        },
        {});

    adobeDCView.registerCallback(
        AdobeDC.View.Enum.CallbackType.SAVE_API,
        function(metaData, content, options) {
            var uint8Array = new Uint8Array(content);
            var blob = new Blob([uint8Array], {
                type: 'application/pdf'
            });
            formData = new FormData();
            formData.append('pdfFile', blob, "<?= $doc["NAME"] ?>.pdf");

            return fetch("<?= site_url("pdf/viewer/{$doc["STAGE_ID"]}/{$doc["ID"]}/true") ?>", {
                method: 'POST',
                body: formData,
            }).then(async response => {
                const text = await response.text();
                if (text.startsWith("UPLOADED")) {
                    alert("Sauvegarde réussi!");
                    return new Promise((resolve, reject) => {
                        resolve({
                            code: AdobeDC.View.Enum.ApiResponseCode.SUCCESS,
                            data: {
                                metaData: {
                                    fileName: "<?= $doc["NAME"] ?>.pdf"
                                },
                            },
                        });
                    });
                } else {
                    alert(text);
                    return new Promise((resolve, reject) => {
                        reject({
                            code: AdobeDC.View.Enum.ApiResponseCode.FAIL,
                            data: {
                                metaData: {
                                    fileName: "<?= $doc["NAME"] ?>.pdf"
                                },
                            },
                        });
                    });
                }
            }).catch(console.error);
        }, {
            autoSaveFrequency: 0,
            enableFocusPolling: false,
        }
    );
});
</script>
