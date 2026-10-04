<!DOCTYPE html>
<html lang="en">
   <head>
      @include('Admin.common.headerlink')
      <script src="https://cdn.ckeditor.com/ckeditor5/35.3.2/classic/ckeditor.js"></script>
   </head>
   <body>
      <div class="page-wrapper">
         <div class="main-container">
            @include('Admin.common.sidebar')
            <div class="app-container">
               @include('Admin.common.header')
               <div class="app-hero-header d-flex align-items-start">
                  <ol class="breadcrumb">
                     <li class="breadcrumb-item"><i class="bi bi-house"></i><a href="#">Home</a></li>
                     <li class="breadcrumb-item">Events</li>
                     <li class="breadcrumb-item active">Add Event</li>
                  </ol>
               </div>
               <div class="app-body">
                  <div class="card">
                     <div class="card-header">
                        <h5>Add New Event</h5>
                     </div>
                     <div class="card-body">
                        <form id="eventForm" enctype="multipart/form-data">
                           @csrf
                           <div class="row">
                              <!-- Event Name -->
                              <div class="col-md-6 mb-3">
                                 <label>Event Name</label>
                                 <input type="text" name="event_name" id="event_name" class="form-control" required>
                              </div>
                              <!-- Slug -->
                              <div class="col-md-6 mb-3">
                                 <label>Slug</label>
                                 <input type="text" name="slug" id="slug" class="form-control" readonly>
                              </div>
                              <!-- Location -->
                              <div class="col-md-6 mb-3">
                                 <label>Location</label>
                                 <input type="text" name="location" class="form-control">
                              </div>
                              <!-- Banner -->
                              <div class="col-md-6 mb-3">
                                 <label>Banner Image</label>
                                 <input type="file" name="banner_image" class="form-control">
                              </div>
                              <!-- Start Date -->
                              <div class="col-md-4 mb-3">
                                 <label>Start Date</label>
                                 <input type="date" name="start_date" class="form-control" required>
                              </div>
                              <!-- End Date -->
                              <div class="col-md-4 mb-3">
                                 <label>End Date</label>
                                 <input type="date" name="end_date" class="form-control" required>
                              </div>
                              <!-- Registration Last Date -->
                              <div class="col-md-4 mb-3">
                                 <label>Registration Last Date</label>
                                 <input type="date" name="registration_last_date" class="form-control">
                              </div>
                              <!-- Volunteer Required -->
                              <div class="col-md-4 mb-3">
                                 <label>Volunteer Required</label>
                                 <select name="volunteer_required" class="form-control">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                 </select>
                              </div>
                              <!-- Status -->
                              <div class="col-md-4 mb-3">
                                 <label>Status</label>
                                 <select name="status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Closed</option>
                                 </select>
                              </div>
                              <!-- Featured -->
                              <div class="col-md-4 mb-3">
                                 <label>Featured</label>
                                 <select name="featured" class="form-control">
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                 </select>
                              </div>
                              <!-- Description -->
                              <div class="col-md-12 mb-3">
                                 <label>Description</label>
                                 <textarea name="description" id="description" class="form-control"></textarea>
                              </div>
                              <div class="col-12">
                                 <button type="button" class="btn btn-primary" onclick="submitEventForm()">
                                 Save Event
                                 </button>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
               @include('Admin.common.footer')
            </div>
         </div>
      </div>
      @include('Admin.common.footerlink')
      <script>
         // CKEditor
         let editor;
         ClassicEditor
         .create(document.querySelector('#description'))
         .then(newEditor => {
             editor = newEditor;
         })
         .catch(error => console.error(error));
         
         // Slug auto generate
         $('#event_name').keyup(function(){
             let slug = $(this).val()
                 .toLowerCase()
                 .replace(/ /g,'-')
                 .replace(/[^\w-]+/g,'');
             $('#slug').val(slug);
         });
         
         // Submit
         function submitEventForm(){
         
         let formData = new FormData(document.getElementById('eventForm'));
         
         formData.set('description', editor.getData());
         
         $.ajax({
         url: "{{ route('Events_store') }}",
         type:"POST",
         data:formData,
         processData:false,
         contentType:false,
         success:function(response){
         if(response.success){
         Swal.fire("Success!",response.message,"success")
         .then(()=>window.location.href=response.redirect);
         }else{
         Swal.fire("Error!",response.message,"error");
         }
         },
         error:function(){
         Swal.fire("Error!","Something went wrong.","error");
         }
         });
         
         }
         
      </script>
   </body>
</html>