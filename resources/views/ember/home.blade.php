@extends("layouts.app")
@section('page_title')
    {{ "Label Detection | Glohbal" }}
@endsection
@section('page_sub_title')
    {{ "Product Labels" }}
@endsection
@section("content")
<!-- end:: Header -->
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-grid--stretch">
	<div class="kt-container kt-body  kt-grid kt-grid--ver" id="kt_body">
		<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

			<!-- begin:: Content Head -->
			<div class="kt-subheader   kt-grid__item" id="kt_subheader">
				<div class="kt-subheader__main">
					<h3 class="kt-subheader__title">Dashboard</h3>
					<span class="kt-subheader__separator kt-subheader__separator--v"></span>
					<h3 class="kt-subheader__title">Object Localizer</h3>
				</div>
				<div class="kt-subheader__toolbar">
					
				</div>
			</div>

			<!-- end:: Content Head -->

			<!-- begin:: Content -->
	<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
		<div class="row">
			<div class="col-xl-6">

				<!--begin::Portlet-->
				<div class="kt-portlet">
					<div class="kt-portlet__head">
						<div class="kt-portlet__head-label">
							<h3 class="kt-portlet__head-title">
								Detect Objects By Image
							</h3>
						</div>
					</div>
					<div class="kt-portlet__body">
						<form  onsubmit="return false;" class="kt-form kt-form--label-right" name="ObjectForm" id="ObjectForm" method="post" >

							<div class="form-group form-group-last kt-hide">
	                            <div class="alert alert-danger" role="alert" id="routeForm_msg">
	                                <div class="alert-icon"><i class="flaticon-warning"></i></div>
	                                <div class="alert-text">
	                                    Oh snap! Change a few things up and try submitting again.
	                                </div>
	                                <div class="alert-close">
	                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                                        <span aria-hidden="true"><i class="la la-close"></i></span>
	                                    </button>
	                                </div>
	                            </div>
                        	</div>
							<div class="row">
								<div class="col-md-8">
									<div class="form-group">
										<label>Image URI</label>
										<input required="required" type="url" class="form-control"  placeholder="URL://" name="image_url" id="image_url">
										<span class="form-text text-muted">Enter image link to find objects from Shopbop</span>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group" style="margin-top:5.8%;">
										<button type="submit" class="btn btn-primary detectObjects">Submit</button>
									</div>
								</div>
							</div>
						
						
					</form>
						<!--begin::Section-->
						<div class="kt-section">
							<span class="kt-section__info">
								Google Cloud Object Localizer detects objects and Bounding Box Coordinates
							</span>
							<div class="kt-section__content">
								<table class="table table-dark">
									<thead>
										<tr>
											<th>#</th>
											<th>Object Name</th>
											<th>Score</th>
											<th>Bounds</th>
										</tr>
									</thead>
									<tbody class="objects">
										
									</tbody>
								</table>
							</div>
						</div>

						<!--end::Section-->
					</div>

					<!--end::Form-->
				</div>

				

				<!--end::Portlet-->
			</div>
			
		</div>
	</div>
		</div>
	</div>
</div>

@endsection("content")

@section("pageScripts")
<script type="text/javascript">
	    var userObjectForm = function () {  
        // Private functions

        var initLocalizer = function () {
            $( "#ObjectForm" ).validate({
                // define validation rules
                rules: {
                    image_url: {
                        required: true,
                    }
                },

                //display error alert on form submit
                invalidHandler: function(event, validator) {
                    var alert = $('#ObjectForm_msg');
                    alert.removeClass('kt--hide').show();
                    KTUtil.scrollTop();
                },

                submitHandler: function (form) {
                    var image_url = $("#image_url").val();
                    KTApp.block('#block_app', {
                        overlayColor: '#000000',
                        type: 'v2',
                        state: 'success',
                        message: 'Please wait...'
                    });
                    $.ajax({
                        url: '/detectObjects',
                        data: {image_url:image_url,"_token": "{{ csrf_token() }}"},
                        type: 'post',
                        dataType: 'json',
                        success: function (res) {
                            console.log(res);
                            KTApp.unblock('#block_app');
                            if (res.msg == 'success')
                            {
								$(".objects").html("");
                            	var i = 1;
                            	var row = '';
                            	res.objects.forEach(function (object) {
                            		row = '<tr>';
	                            	row += '<th scope="row">'+ i +'</th>';
	                            	row += '<td>'+ object.name+ '</td>';
	                            	row += '<td>'+ object.score+ '</td>';
	                            	row += '<td>'+ object.bounds+ '</td>';
	                            	row += '</tr>';
	                            	$(".objects").append(row);
	                            	i++;
								});
                                
                            }
                            else if(res.msg == 'error')
                            {
                                swal.fire("No objects detected", res.msg, "error");
                            }
                        }
                    });
                }
            });
        }
        return {
            // public functions
            init: function() {
                initLocalizer();
            }
        };
    }();

    jQuery(document).ready(function() {
        userObjectForm.init();
    });

    // $('#kt_select2_3').select2({
    //         placeholder: "Select User",
    //     });


        "use strict";
var KTDatatablesExtensionsRowreorder = function() {

    var initTable1 = function() {
        var table = $('#kt_table_1_1');

        // begin first table
        table.DataTable({
            responsive: true,
            order:[[5,"desc"]],
            columnDefs: [
                
            ],
        });
    };

    return {

        //main function to initiate the module
        init: function() {
            initTable1();
        },

    };

}();

jQuery(document).ready(function() {
    KTDatatablesExtensionsRowreorder.init();
});

    

</script>
@endsection("pageScripts")