<div
    wire:ignore
    x-data
    x-init="
        onUploadSuccess = (elForUploadedFiles) =>
          (file, response) => {
            var inputElementUrlUploadFile = document.getElementById('{{ $hiddenField }}');
            inputElementUrlUploadFile.value = response.uploadURL;
            inputElementUrlUploadFile.dispatchEvent(new Event('input'));
            {{ $extraJSForOnUploadSuccess }}
          };

        uppyUpload = new Uppy({{ $options }});

        uppyUpload
          .use(Dashboard, {
              inline: true,
              target: '.DashboardContainer',
              replaceTargetContent: true,
              showProgressDetails: true,
              note: '',
              height: 300,
              browserBackButtonClose: false
          })
          .use(AwsS3Multipart, {
              companionUrl: '/',
          })
          .on('upload-success', onUploadSuccess());
    "
>
    <section class="upload">
      <div class="DashboardContainer" x-ref="input"></div>
    </section>
</div>