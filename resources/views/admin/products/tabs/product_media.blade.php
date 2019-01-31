 @php 
use App\File;
@endphp 

 @push('js')

 <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js">
	
</script>
<script type="text/javascript">
	Dropzone.autoDiscover = false;
	$(document).ready(function () {
		  
		   $('#dropzonefileupload').dropzone({
		 	url:"{{ aurl('upload/image/'.$product->id) }}",
		 	paramName:'file',
		 	uploadMultiple:false,
		 	maxFiles:15,
		 	maxFilessaze:2,
		 	acceptedFiles:'image/*',
		 	dictDefaultMessage:' اضغط هنا لرفع الملفات او قم بسحب الملفات وادرجه هنا ',
		 	dictRemoveFile:"{{ trans('admin.delete') }} ",
 		 	params:{
		 		_token:'{{csrf_token() }}'


		 	},
		 		addRemoveLinks:true,
		 		removedfile:function(file)
		 		{
		 			//alert(file.fid);
		 			$.ajax({
		 			dataType:'json',
		 			type:'post',
		 			url:'{{ aurl('delete/image') }}',
		 			data:{_token:'{{csrf_token() }}',id:file.fid}
 
		 			});
		 			var fmok;
	return (fmok = file.previewElement) !=null ? fmok .parentNode.removeChild(file.previewElement):void 0;
		 		},

		 	init:function(){
		 		@foreach($product->files()->get() as  $file)
		 		var mock={name:'{{ $file->file_type}}',fid:'{{ $file->id}}',size:'{{ $file->size}}',type:'{{ $file->mime_type}}'};
		 	this.emit('addedfile',mock);
		 	this.options.thumbnail.call(this,mock,'{{ url('storage/'.$file->full_file) }}') ;
		 		 		@endforeach

  this.on('sending',function(file,xhr,formData){

  	formData.append('fid','');
  	file.fid = '';
  });
  this.on('success',function(file,response){
  	file.fid = response.id;
  				});
		 	}
		 });
	});
  

 </script>
</script>
 @endpush
  <div id="product_media" class="tab-pane fade  ">

       <h3>{{ trans('admin.product_media') }}</h3>  
      <div class="dropzone" id="dropzonefileupload"></div>
    </div>
