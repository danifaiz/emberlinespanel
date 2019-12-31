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
            maxFilesize: 5, // MB
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
                                toastr.options = {
                                    "closeButton": false,
                                    "debug": false,
                                    "newestOnTop": false,
                                    "progressBar": false,
                                    "positionClass": "toast-top-right",
                                    "preventDuplicates": false,
                                    "onclick": null,
                                    "showDuration": "300",
                                    "hideDuration": "1000",
                                    "timeOut": "5000",
                                    "extendedTimeOut": "1000",
                                    "showEasing": "swing",
                                    "hideEasing": "linear",
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut"
                                };
                    
                                toastr.success("Project Saved Successfully!");
                              
                            }
                        },
                        error: function(xhr, error){
                            KTApp.unblock('#block_app');
                            toastr.options = {
                                "closeButton": false,
                                "debug": false,
                                "newestOnTop": false,
                                "progressBar": false,
                                "positionClass": "toast-top-right",
                                "preventDuplicates": false,
                                "onclick": null,
                                "showDuration": "300",
                                "hideDuration": "1000",
                                "timeOut": "5000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            };
                            let errorMessage = JSON.parse(xhr.responseText);
                            toastr.warning(errorMessage.errors.title[0]);
                            window.location.href = "/admin/projects";
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