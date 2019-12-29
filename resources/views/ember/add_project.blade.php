@extends("layouts.app")
@section('page_title')
    {{ "Emberlines | Add Project" }}
@endsection
@section('page_sub_title')
    {{ "ADMIN PANEL" }}
@endsection
@section('pageStyles')
<style>
    .polyp {
        font-size: 14px; color:black;
        font-weight:bold;
    }
    .scorestyle {
        font-size: 12px;
        margin:1% 0%;
        display:none;
    }
    #exampleModalLabel {
        font-family: 'Muli','Poppins';
        font-weight: bold;
    }
    .myshadow {
        box-shadow: 0px 0px 3px 1px #f2f2f2;
        margin-bottom:1em;
        border-radius:1%;
    }
    .mt-btm-1 {
       margin-bottom:1em;  
    }
    .product_image {
        margin: 0px 25%;
    }
    .move-right {
        text-align:right;
    }
    .btn-outline-danger {
        padding: 0.3rem 0.5rem !important;
        color: #fd397a !important;
        border-color: #fd397a !important;
    }
    
    .btn-outline-danger:hover {
        color:white !important;
        background-color:#fd397a !important;
    }
    .select2 {
        width:295px;
    }
    .dz-progress {
        /* progress bar covers file name */
        display: none !important;
    }
</style>
@endsection
@section("content")

<!-- end:: Header -->
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-grid--stretch" style="margin-top:1%;">
	<div class="kt-container kt-body  kt-grid kt-grid--ver" id="kt_body">
		<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

			<!-- begin:: Content Head -->
			<div class="kt-subheader   kt-grid__item" id="kt_subheader">
				<div class="kt-subheader__main">
					<h3 class="kt-subheader__title">Dashboard</h3>
					<span class="kt-subheader__separator kt-subheader__separator--v"></span>
					<h3 class="kt-subheader__title">Add Project</h3>
				</div>
				<div class="kt-subheader__toolbar">
					
				</div>
			</div>
            <div class="kt-portlet__body">
                    <div class="form-group form-group-last kt-hide">
                        <div class="alert alert-danger" role="alert" id="project_form_msg">
                            <div class="alert-icon"><i class="flaticon-warning"></i></div>
                            <div class="alert-text">
                                Oh snap! Make sure to provide all project details.
                            </div>
                            <div class="alert-close">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="la la-close"></i></span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 myshadow">
                            <div class="move-left">
                                    {{-- <button type="button" class="btn btn-outline-danger btn-sm reset_filters" >Go Back</button> --}}
                            </div>
                            <div class="row">
                                <div class="container">

                                
                            <form method="POST" onsubmit="return false;" id="project-form" style="margin-top: 2%;">
                                 <div class="form-group" style="margin-bottom:0.5em;">
                                        <label>Title</label>
                                    <input required="required" type="text" class="form-control"   placeholder="Project Title" name="title" id="title">
                                    <span class="form-text text-muted">Enter Project Title</span>
                                </div> 
                                <div class="form-group" style="margin-bottom:0.5em;">
                                    <label>Description</label>
                                    <textarea required="required" class="form-control"   placeholder="Your description goes here..." rows="6" name="description" id="description"></textarea>
                                    <span class="form-text text-muted">Enter Project Description</span>
                                </div>
                                <div class="form-group" style="margin-bottom:0.5em;">
                                        <label style="text-align: left;">Categories / Tags</label>
                                        <select class="form-control m-select2" multiple name="categories[]" id="categories">
                                            @foreach($categories as $tag)
                                            <option value="{{$tag['name']}}">{{$tag['name']}}</option>
                                            @endforeach
                                        </select>
                                </div>
                                <div class="form-group">
                                        <label>Banner Image</label>
                                        <div></div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="banner_image" id="banner_image">
                                            <label class="custom-file-label" for="banner_image">Choose file</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="kt-dropzone dropzone" action="saveProject" id="k-dropzone-one" style="margin-bottom:0.5em;">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <div class="kt-dropzone__msg dz-message needsclick">
                                                <h3 class="kt-dropzone__msg-title">Drop Project Images here or click to upload.</h3>
                                                <span class="kt-dropzone__msg-desc"></span>
                                            </div>
                                        </div>
                                    </div>
                                        
                                    <div class="col-lg-12 col-md-12 col-sm-12 mt-btm-1">
                                        <div class="btn-group btn-group-lg col-lg-12 col-md-12 col-sm-12" style="padding:0 !important; height:42px;"role="group" aria-label="Large button group">
                                            <button type="submit" name="submit" class="btn btn-sm btn-outline-success save_project" style="padding:0 !important; font-size:14px;">Save Project</button>
                                        </div>
                                    </div>
                                        
                                    
                                </form>
                            </div>
                        </div>
                            
                            
                        </div>
                        
                        
                    </div>
                        
                    </div>

			<!-- end:: Content Head -->

			<!-- begin:: Content -->
	
		</div>
	</div>
</div>

@endsection

@section("pageScripts")
    <script src="//cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.4.0/clipboard.min.js"></script>
    <script>
        var baseUrl = "{{asset('/')}}";
    </script>
    <script src="{{ asset('app/bundle/ember.js')}}"></script>
@endsection