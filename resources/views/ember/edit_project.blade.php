@extends("layouts.master")
@section('page_title')
    {{ "Emberlines | Edit Project" }}
@endsection
@section('page_sub_title')
    {{ "ADMIN PANEL" }}
@endsection
@section('pageStyles')
<style>
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
    #gallery-items { list-style-type: none; margin: 0; padding: 0;  }
    #gallery-items li { 
        background: #A1C5DA; 
        box-shadow: 0px 0px 4px 0px #125772; 
        margin: 12px 12px 12px 0; 
        padding: 2%; 
        float: left; 
        font-size: 4em; 
        text-align: center; 
        
        }
    #gallery-items li {
        cursor: move; /* fallback if grab cursor is unsupported */
        cursor: grab;
        cursor: -moz-grab;
        cursor: -webkit-grab;
    }

    /* (Optional) Apply a "closed-hand" cursor during drag operation. */
    #gallery-items li:active {
        cursor: grabbing;
        cursor: -moz-grabbing;
        cursor: -webkit-grabbing;
    }
    .toggle {
    margin: 0 0 1.5rem;
    box-sizing: border-box;
    font-size: 0;
    display: flex;
    flex-flow: row nowrap;
    justify-content: flex-start;
    align-items: stretch;
    }
    .toggle input {
    width: 0;
    height: 0;
    position: absolute;
    left: -9999px;
    }
    .toggle input + label {
    margin: 0;
    padding: .75rem 2rem;
    box-sizing: border-box;
    position: relative;
    display: inline-block;
    border: solid 1px #DDD;
    background-color: #FFF;
    font-size: 1rem;
    line-height: 140%;
    font-weight: 600;
    text-align: center;
    box-shadow: 0 0 0 rgba(255, 255, 255, 0);
    transition: border-color .15s ease-out,  color .25s ease-out,  background-color .15s ease-out, box-shadow .15s ease-out;
    /* ADD THESE PROPERTIES TO SWITCH FROM AUTO WIDTH TO FULL WIDTH */
    /*flex: 0 0 50%; display: flex; justify-content: center; align-items: center;*/
    /* ----- */
    }
    .toggle input + label:first-of-type {
    border-radius: 6px 0 0 6px;
    border-right: none;
    }
    .toggle input + label:last-of-type {
    border-radius: 0 6px 6px 0;
    border-left: none;
    }
    .toggle input:hover + label {
    border-color: #213140;
    cursor:pointer;
    }
    .toggle input:checked + label {
    background-color: #4B9DEA;
    color: #FFF;
    box-shadow: 0 0 10px rgba(102, 179, 251, 0.5);
    border-color: #4B9DEA;
    z-index: 1;
    }
    .toggle input:focus + label {
    outline: none;
    outline-offset: .45rem;
    }
    @media (max-width: 800px) {
    .toggle input + label {
        padding: .75rem .25rem;
        flex: 0 0 50%;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    }

    /* STYLING FOR THE STATUS HELPER TEXT FOR THE DEMO */
    .status {
    margin: 0;
    font-size: 1rem;
    font-weight: 400;
    }
    .status span {
    font-weight: 600;
    color: #B6985A;
    }
    .status span:first-of-type {
    display: inline;
    }
    .status span:last-of-type {
    display: none;
    }
    @media (max-width: 800px) {
    .status span:first-of-type {
        display: none;
    }
    .status span:last-of-type {
        display: inline;
    }
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
					<h3 class="kt-subheader__title">Edit Project</h3>
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
                                <form action="/admin/projects" method="GET">
                                    <button type="submit" class="btn btn-outline-info btn-sm reset_filters" ><i class="fas fa-arrow-left"></i> Go Back</button>
                            </form>
                            </div>
                            <div class="row">
                                <div class="container">

                                
                            <form method="POST" onsubmit="return false;" id="project-form" style="margin-top: 2%;">
                                    <input type="hidden" name="project_id" value="{{ $project["id"] }}">
                                 <div class="form-group" style="margin-bottom:0.5em;">
                                        <label>Title</label>
                                 <input required="required" type="text" class="form-control" value="{{$project["title"]}}"   placeholder="Project Title" name="title" id="title">
                                    <span class="form-text text-muted">Enter Project Title</span>
                                </div> 
                                <div class="form-group" style="margin-bottom:0.5em;">
                                    <label>Description</label>
                                    <textarea required="required" class="form-control"   placeholder="Your description goes here..." rows="6" name="description" id="description">{{$project["description"]}}</textarea>
                                    <span class="form-text text-muted">Enter Project Description</span>
                                </div>
                                <div class="form-group" style="margin-bottom:0.5em;">
                                        <label style="text-align: left;">Categories / Tags</label>
                                        <select class="form-control m-select2" multiple name="categories[]" id="categories">
                                            @foreach($defaultCategories as $tag)
                                                <option @if(in_array($tag["name"],$projectTags)) {{ "selected" }} @endif  value="{{$tag['id']}}">{{$tag['name']}}</option>
                                            @endforeach
                                        </select>
                                </div>
                                <div class="form-group">
                                        <label>Banner Image</label>
                                        <div></div>
                                        <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="banner_image" id="banner_image">
                                            <label class="custom-file-label" for="banner_image">{{$project["banner_image"]}}</label>
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
                                        
                                    <div class="row">
                                            <div class="kt-portlet__head">
                                                    <div class="kt-portlet__head-label">
                                                        <h3 class="kt-portlet__head-title">
                                                          <i class="fa fa-cog"></i> Adjust Order & Grid
                                                        </h3>
                                                    </div>
                                                </div>
                                            <div class="kt-portlet__body" style="width:100%;">
                                                <ul id="gallery-items" class="list-inline">
                                                    @foreach($project["gallery"] as $key=> $galleryImage)
                                                <li class="highlight" id={{$key + 1}} data-image-id="{{$galleryImage['imageId']}}">
                                                        <div>
                                                            
                                                        <div class="toggle">
                                                        <input type="radio" name="{{ __('grid-'. $galleryImage['imageId'])  }}" value="6" id="{{ __('6-Column-'. $galleryImage['imageId'])  }}" checked="checked" />
                                                            <label for="{{ __('6-Column-'. $galleryImage['imageId'])  }}">6 Column Grid</label>
                                                            <input type="radio" name="{{ __('grid-'. $galleryImage['imageId'])  }}" value="12" id="{{ __('12-Column-'. $galleryImage['imageId'])  }}" />
                                                            <label for="{{ __('12-Column-'. $galleryImage['imageId'])  }}">12 Column Grid</label>
                                                        </div>
        
                                                        </div>
                                                        <img width="250" src="{{ $galleryImage['cloudUrl']}}" alt="{{$galleryImage['name']}}" srcset="">
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 mt-btm-1">
                                        <div class="btn-group btn-group-lg col-lg-12 col-md-12 col-sm-12" style="padding:0 !important; height:42px;"role="group" aria-label="Large button group">
                                            <button type="submit" name="submit" class="btn btn-sm btn-outline-success save_project" style="padding:0 !important; font-size:14px;"><i class="fas fa-save"></i>Update Project</button>
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
        var projectGallery = @json($project['gallery']);
        console.log(projectGallery);
    </script>
    <script src="{{ asset('ember/editproject.js')}}" type="text/javascript"></script>
    <script src="{{ asset('app/bundle/ember.js')}}"></script>
@endsection