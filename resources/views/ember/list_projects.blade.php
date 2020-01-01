@extends("layouts.master")
@section('page_title')
    {{ "Emberlines | Projects" }}
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
    .wrap-text {
        word-wrap:break-word;
        width:70%;
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
					<h3 class="kt-subheader__title">Project Stack</h3>
				</div>
				<div class="kt-subheader__toolbar">
                        @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                        <script>
                            setTimeout(()=>{
                                $(".alert").fadeOut();
                            },3000);
                         </script>
                        @endif
				</div>
			</div>
            <div class="kt-portlet__body">
                    
                    <div class="row">
                        <div class="col-md-12 myshadow">
                           <div class="kt-portlet kt-portlet--mobile">
                            <div class="kt-portlet__head kt-portlet__head--lg">
                                <div class="kt-portlet__head-label">
                                    <span class="kt-portlet__head-icon">
                                        <i class="kt-font-brand flaticon2-line-chart"></i>
                                    </span>
                                    <h3 class="kt-portlet__head-title">
                                        Emberlines Projects
                                    </h3>
                                </div>
                                <div class="kt-portlet__head-toolbar">
                                    <div class="kt-portlet__head-wrapper">
                                        <div class="kt-portlet__head-actions">
                                            <a href="/admin/project/add" class="btn btn-brand btn-elevate btn-icon-sm">
                                                <i class="la la-plus"></i>
                                                New Project
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-portlet__body">

                                <!--begin: Datatable -->
                                <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                                    <thead>
                                        <tr>
                                            <th>Project</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Tags</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($projects as $project)
                                            <tr>
                                                <td><img width="80" src="/images/{{$project->banner_image}}" alt="{{$project->banner_image}}"></td>
                                                <td>{{$project->title}}</td>
                                                <td class="wrap-text">{{$project->description}}</td>
                                                <td>
                                                    @foreach($project->categories as $tag)
                                                        <span style="margin:3px 0px;" class="kt-badge kt-badge--info kt-badge--inline kt-badge--pill kt-badge--rounded">{{$tag->name}}</span>
                                                    @endforeach
                                                </td>
                                                <td nowrap>
                                                    <a href="/admin/project/{{$project->id}}" class="btn btn-sm btn-clean btn-icon btn-icon-md"  data-skin="dark" data-toggle="kt-tooltip" data-placement="top" title="Edit">
                                                            <i class="la la-edit"></i>
                                                    </a>
                                                    <form action="{{ url('/admin/project/remove', ['id' => $project->id]) }}" method="POST">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit"  onclick="return confirm('Are you sure?')" class="btn btn-sm btn-clean btn-icon btn-icon-md"  data-skin="dark" data-toggle="kt-tooltip" data-placement="top" title="Delete">
                                                            <i class="la la-remove"></i>
                                                        </a>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <!--end: Datatable -->
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