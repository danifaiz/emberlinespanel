"use strict";
// Class definition
var projectFormData;
var KTDropzoneDemo = function () {    
    // Private functions
    var demos = function () {
        // single file upload
        Dropzone.options.kDropzoneOne = {
            paramName: "file", // The name that will be used to transfer the file
            transformFile: function(file, done) { },
            maxFiles: 15,
            autoProcessQueue: false,
            maxFilesize: 25, // MB
            addRemoveLinks: true,
            acceptedFiles: "image/*",
            timeout: 500000,
            url: 'saveProject',
            init: function() {
                var myDropzone = this;

                $(".save_project").click(function (e) {
                    e.preventDefault();
                    var form = $('#project-form')[0]; // You need to use standard javascript object here
                    var formData = new FormData(form);
                    // myDropzone.processQueue();
                    var galleryFiles = myDropzone.files;
                    galleryFiles.forEach(function(image, i) {
                        formData.append('gallery_' + i, image);
                    });
                    if($.trim($("#title").val()) == "" || $.trim($("#description").val()) == "" || $.trim($("#categories").val()) == "" || $('#banner_image').get(0).files.length === 0 || galleryFiles.length === 0) {
                        var alert = $('#project_form_msg');
                        alert.parent().removeClass('kt-hide').show();
                        KTUtil.scrollTop();
                        setTimeout(()=>{
                            alert.parent().fadeOut();
                        },3000);
                        return;
                    }
                    formData.append('X-CSRF-TOKEN',$('input[name="_token"]').val());
                    KTApp.block('#block_app', {
                        overlayColor: '#000000',
                        type: 'v2',
                        state: 'success',
                        message: 'Please wait...'
                    });
                    $.ajax({
                        url: '/saveProject',
                        data: formData,
                        type: 'post',
                        dataType: 'json',
                        contentType: false, 
                        processData: false, 
                        success: function (res, textStatus, xhr) {
                            console.log(res);
                            KTApp.unblock('#block_app');
                            if (xhr.status == 200)
                            {
                                showToaster("Project Saved Successfully!","success");
                                setTimeout(()=>{
                                    window.location.href = "/admin/projects";
                                },2000)
                            }
                        },
                        error: function(xhr, error){
                            KTApp.unblock('#block_app');
                            let errorMessage = JSON.parse(xhr.responseText);
                            showToaster(errorMessage,"warning");
                        }
                    });
                });
            },
            accept: function(file, done) {
                if (file.name == "justinbieber.jpg") {
                    done("Naha, you don't.");
                } else { 
                    done(); 
                }
            }   
        };
    }

    return {
        // public functions
        init: function() {
            demos(); 
        }
    };
}();

KTDropzoneDemo.init();