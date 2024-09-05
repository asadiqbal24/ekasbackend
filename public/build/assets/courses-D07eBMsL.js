$(function(){var d=$(".datatables-users"),c=$(".select2");baseUrl+"";var i=$("#offcanvasAddUser");if(c.length){var l=c;select2Focus(l),l.wrap('<div class="position-relative"></div>').select2({placeholder:"Select Country",dropdownParent:l.parent()})}if($.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")}}),d.length)var u=d.DataTable({processing:!0,serverSide:!0,ajax:{url:baseUrl+"courses-list"},columns:[{data:"id"},{data:"universityname"},{data:"programmename"},{data:"ranking"},{data:"location"}],columnDefs:[{targets:0,render:function(t,a,s,r){var e=s.universityname;return'<span class="user-email">'+e+"</span>"}},{targets:1,className:"text-center",render:function(t,a,s,r){var e=s.programmename;return'<span class="datetime">'+e+"</span>"}},{targets:2,className:"text-center",render:function(t,a,s,r){var e=s.ranking;return'<span class="datetime">'+e+"</span>"}},{targets:3,className:"text-center",render:function(t,a,s,r){var e=s.location;return'<span class="datetime">'+e+"</span>"}},{targets:-1,title:"Actions",searchable:!1,orderable:!1,render:function(t,a,s,r){return`<a href="/delete/admin/course/${s.id}" class="btn btn-sm btn-icon btn-text-secondary rounded-pill waves-effect" data-id="4301" onclick="return confirm('Are you sure you want to delete this?')"><i class="ri-delete-bin-7-line ri-20px"></i></a>

              <a href="/edit/admin/course/${s.id}" class="btn btn-sm btn-icon  btn-text-secondary rounded-pill waves-effect" data-id="${s.id}" ><i class="ri-edit-line ri-20px"></i></a>`}}],order:[[2,"desc"]],dom:'<"card-header d-flex rounded-0 flex-wrap pb-md-0 pt-0"<"me-5 ms-n2"f><"d-flex justify-content-start justify-content-md-end align-items-baseline"<"dt-action-buttons d-flex align-items-start align-items-md-center justify-content-sm-center gap-4"lB>>>t<"row mx-1"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',lengthMenu:[7,10,20,50,70,100],language:{sLengthMenu:"_MENU_",search:"",searchPlaceholder:"Search",info:"Displaying _START_ to _END_ of _TOTAL_ entries"},buttons:[{extend:"collection",className:"btn btn-outline-secondary dropdown-toggle me-4 waves-effect waves-light",text:'<i class="ri-upload-2-line ri-16px me-2"></i><span class="d-none d-sm-inline-block">Export </span>',buttons:[{extend:"print",title:"Users",text:'<i class="ri-printer-line me-1" ></i>Print',className:"dropdown-item",exportOptions:{columns:[1,2,3,4,5],format:{body:function(t,a,s){if(t.length<=0)return t;var r=$.parseHTML(t),e="";return $.each(r,function(o,n){n.classList!==void 0&&n.classList.contains("user-name")?e=e+n.lastChild.firstChild.textContent:n.innerText===void 0?e=e+n.textContent:e=e+n.innerText}),e}}},customize:function(t){$(t.document.body).css("color",config.colors.headingColor).css("border-color",config.colors.borderColor).css("background-color",config.colors.body),$(t.document.body).find("table").addClass("compact").css("color","inherit").css("border-color","inherit").css("background-color","inherit")}},{extend:"csv",title:"Users",text:'<i class="ri-file-text-line me-1" ></i>Csv',className:"dropdown-item",exportOptions:{columns:[1,2,3,4,5],format:{body:function(t,a,s){if(t.length<=0)return t;var r=$.parseHTML(t),e="";return $.each(r,function(o,n){n.classList!==void 0&&n.classList.contains("user-name")?e=e+n.lastChild.firstChild.textContent:n.innerText===void 0?e=e+n.textContent:e=e+n.innerText}),e}}}},{extend:"excel",title:"Users",text:'<i class="ri-file-excel-line me-1"></i>Excel',className:"dropdown-item",exportOptions:{columns:[1,2,3,4,5],format:{body:function(t,a,s){if(t.length<=0)return t;var r=$.parseHTML(t),e="";return $.each(r,function(o,n){n.classList!==void 0&&n.classList.contains("user-name")?e=e+n.lastChild.firstChild.textContent:n.innerText===void 0?e=e+n.textContent:e=e+n.innerText}),e}}}},{extend:"pdf",title:"Users",text:'<i class="ri-file-pdf-line me-1"></i>Pdf',className:"dropdown-item",exportOptions:{columns:[1,2,3,4,5],format:{body:function(t,a,s){if(t.length<=0)return t;var r=$.parseHTML(t),e="";return $.each(r,function(o,n){n.classList!==void 0&&n.classList.contains("user-name")?e=e+n.lastChild.firstChild.textContent:n.innerText===void 0?e=e+n.textContent:e=e+n.innerText}),e}}}},{extend:"copy",title:"Users",text:'<i class="ri-file-copy-line me-1"></i>Copy',className:"dropdown-item",exportOptions:{columns:[1,2,3,4,5],format:{body:function(t,a,s){if(t.length<=0)return t;var r=$.parseHTML(t),e="";return $.each(r,function(o,n){n.classList!==void 0&&n.classList.contains("user-name")?e=e+n.lastChild.firstChild.textContent:n.innerText===void 0?e=e+n.textContent:e=e+n.innerText}),e}}}}]}],responsive:{details:{display:$.fn.dataTable.Responsive.display.modal({header:function(t){var a=t.data();return"Details of "+a.name}}),type:"column",renderer:function(t,a,s){var r=$.map(s,function(e,o){return e.title!==""?'<tr data-dt-row="'+e.rowIndex+'" data-dt-column="'+e.columnIndex+'"><td>'+e.title+":</td> <td>"+e.data+"</td></tr>":""}).join("");return r?$('<table class="table"/><tbody />').append(r):!1}}}});$(document).on("click",".delete-record",function(){var t=$(this).data("id"),a=$(".dtr-bs-modal.show");a.length&&a.modal("hide"),Swal.fire({title:"Are you sure?",text:"You won't be able to revert this!",icon:"warning",showCancelButton:!0,confirmButtonText:"Yes, delete it!",customClass:{confirmButton:"btn btn-primary me-3",cancelButton:"btn btn-label-secondary"},buttonsStyling:!1}).then(function(s){s.value?($.ajax({type:"DELETE",url:`${baseUrl}user-list/${t}`,success:function(){u.draw()},error:function(r){console.log(r)}}),Swal.fire({icon:"success",title:"Deleted!",text:"The user has been deleted!",customClass:{confirmButton:"btn btn-success"}})):s.dismiss===Swal.DismissReason.cancel&&Swal.fire({title:"Cancelled",text:"The User is not deleted!",icon:"error",customClass:{confirmButton:"btn btn-success"}})})}),$(document).on("click",".edit-record",function(){var t=$(this).data("id"),a=$(".dtr-bs-modal.show");a.length&&a.modal("hide"),$("#offcanvasAddUserLabel").html("Edit User"),$.get(`${baseUrl}user-list/${t}/edit`,function(s){$("#user_id").val(s.id),$("#add-user-fullname").val(s.name),$("#add-user-email").val(s.email)})}),$(".add-new").on("click",function(){$("#user_id").val(""),$("#offcanvasAddUserLabel").html("Add User")});const m=document.getElementById("addNewUserForm"),p=FormValidation.formValidation(m,{fields:{name:{validators:{notEmpty:{message:"Please enter fullname"}}},email:{validators:{notEmpty:{message:"Please enter your email"},emailAddress:{message:"The value is not a valid email address"}}},userContact:{validators:{notEmpty:{message:"Please enter your contact"}}},company:{validators:{notEmpty:{message:"Please enter your company"}}}},plugins:{trigger:new FormValidation.plugins.Trigger,bootstrap5:new FormValidation.plugins.Bootstrap5({eleValidClass:"",rowSelector:function(t,a){return".mb-5"}}),submitButton:new FormValidation.plugins.SubmitButton,autoFocus:new FormValidation.plugins.AutoFocus}}).on("core.form.valid",function(){$.ajax({data:$("#addNewUserForm").serialize(),url:`${baseUrl}user-list`,type:"POST",success:function(t){u.draw(),i.offcanvas("hide"),Swal.fire({icon:"success",title:`Successfully ${t}!`,text:`User ${t} Successfully.`,customClass:{confirmButton:"btn btn-success"}})},error:function(t){i.offcanvas("hide"),Swal.fire({title:"Duplicate Entry!",text:"Your email should be unique.",icon:"error",customClass:{confirmButton:"btn btn-success"}})}})});i.on("hidden.bs.offcanvas",function(){p.resetForm(!0)});const f=document.querySelectorAll(".phone-mask");f&&f.forEach(function(t){new Cleave(t,{phone:!0,phoneRegionCode:"US"})})});
