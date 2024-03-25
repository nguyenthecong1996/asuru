$('body').on('submit', '.base-form', function() {
    $(this).find('button[type="submit"]').attr('disabled', 'disabled');
})

function confirmDelete(url, datatable = $('#datatable'), name) {
    Swal.fire({
        title: trans.detele_item.title,
        icon: "warning",
        showCancelButton: true,
        cancelButtonText: trans.detele_item.cancel,
        confirmButtonText: trans.detele_item.button,
    }).then(function (result) {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                type: "DELETE",
            })
                .done(function (response) {
                    toastr.success("Deleted " +name+ " Successfully");
                    datatable.DataTable().draw();
                })
                .fail(function (response) {
                    toastr.error("Delete failed");
                });
        }
    });
}

function randomPassword(element) {
    let min = 100000;
    let max = 999999;
    let random_password = Math.floor(Math.random() * (max - min + 1)) + min;
    element.attr('value', random_password);
}

function previewImage(fileInput, previewImg = $('.preview-img')) {
    fileInput.trigger('click')

    fileInput.change(function() {
        let reader = new FileReader();
        reader.onload = function (e) {
            let src = e.target.result;
            previewImg.children('img').attr('src', src);
            previewImg.removeClass('d-none')
            previewImg.css('border', 'none');
        }
        reader.readAsDataURL(this.files[0]);
    })
    
}

function previewPdf(fileInput, previewImg = $('.preview-pdf')) {
    fileInput.trigger('click')

    fileInput.change(function() {
        let reader = new FileReader();

        var file = this.files[0].name;
        var ext = file.split('.').pop();
        if ($(".show-filename-pdf")[0]){
            $(".show-filename-pdf").html('')
        }
        $('.preview-pdf img').html('')
        console.log(file)
        if(ext == 'pdf') {
            console.log(file)
            previewImg.children('img').attr('src', 'https://upload.wikimedia.org/wikipedia/commons/4/42/Pdf-2127829.png');
            previewImg.removeClass('d-none')
            previewImg.css('border', 'none');
            previewImg.append(`<p class="show-filename-pdf">${file}</p>`)
            reader.readAsDataURL(this.files[0]);
        }
    })
    
}

function isset(value) {
    if(typeof(value) != "undefined" && value !== null) {
        return true;
    }
    return false;
}

function dateIsValid(dateStr) {
    const regex = /^\d{4}-\d{2}-\d{2}$/;
  
    if (dateStr.match(regex) === null) {
      return false;
    }
  
    const date = new Date(dateStr);
  
    const timestamp = date.getTime();
  
    if (typeof timestamp !== 'number' || Number.isNaN(timestamp)) {
      return false;
    }
  
    return date.toISOString().startsWith(dateStr);
}
  

