loadthis = function(me){
	var link = $(me).attr("link");
	var log_group_id = $(me).attr("groupid");
	var linkname = '<li class="active"><i class="fa fa-dashboard"></i> ' + $(me).attr("linkname") + "</li>";
	var url = link;
	$(".swu_menutitle li").each(function(){
		$(this).removeClass("active");
	});
	$(me).parent().addClass("active");
	var timer = null, 
        interval = 2000;

	if(link == "dashboard"){
		$.ajax({
			url: "dashboard/home",
			data: {},
			type: 'GET',
			dataType: 'html',
			success: function(html){
				$(".breadcrumb").html(linkname);
				$(".content .col-lg-12").html(html);
				$(".send_message_button").click(function(){
					var mes = $.trim($("input.message_input").val());					
					if(mes != "" && mes.length > 0){
						$.ajax({
							url: "dashboard/sendchatmessage",
							data: {mes:mes},
							type: 'POST',
							dataType: 'html',
							success: function(html){
								$(".panel-body .list-group").html(html);
							},
							error: function(e){
								console.log(e);
							}
						});
					}
					$("input.message_input").val("");
				});

				timer = setInterval(function(){
					$.ajax({
						url: "dashboard/updatechatmessage",
						data: {},
						type: 'POST',
						dataType: 'html',
						success: function(html){
							$(".panel-body .list-group").html(html);
						},
						error: function(e){
							console.log(e);
						}
					});
				},interval);
			},
			error: function(e){
				console.log(e);
			}
		});
	}else{
				
		$.ajax({
			url:url,
			data: {},
			type: "GET",
			cache: false,
			dataType: "html",
			success: function(html){
				$(".breadcrumb").html(linkname);
				$(".content .col-lg-12").html(html);

				//initial load sa Grade, default to Group
				if(link == "grade" && log_group_id != 1){
					$.ajax({
						url: "grade/loadgroupgrade",
						data: {},
						dataType: "html",
						type: "html",
						success: function(html){
							$("#group_grading_content .group").html(html);							

							$(".input-box-td .display").click(function(e){
								e.preventDefault();
								var me = this;
								$(".input-box-td").each(function(){
									$(this).find(".display").removeClass("hide");
									$(this).find(".input-box").addClass("hide");
								});
								$(me).addClass("hide");
								$(me).next().removeClass("hide").focusout(function(){
									if($(this).find(".input-grade").val() < 10){
										alert("sayop");
									}
								});								
							});							
						},
						error: function(e){
							console.log(e);
						}
					});
				}
				//New Grading sysmte
				$('#grading_group_tab a').click(function (e) {
					  e.preventDefault();
					  $(this).tab('show');
				});
				//attendance view report
				$(".attendance_report").click(function(){
					$.ajax({
						url: "attendance/viewreport",
						data: {},
						dataType: 'html',
						type: 'GET',
						success: function(html){
							$("<li class='active'>View Attendance Report</li>").insertAfter($(".breadcrumb li"));
							$(".content .col-lg-12").html(html);
						},
						error: function(e){
							console.log(e)
						}
					});
				});

				//Attendace LOGIn
				$(".attendance_login").click(function(){
					var id = $(this).attr("s_id");
					$(this).attr("disabled","disabled");
					$.ajax({
						url: "attendance/studentlogin",
						data: {id:id},
						dataType: 'json',
						type: 'POST',
						success: function(d){
							console.log(d);
						},
						error: function(e){
							console.log(e);
						}
					});
				});
				//Studen LOGOUT
				$(".attendance_logout").click(function(){
					var id = $(this).attr("s_id");
					$(this).attr("disabled","disabled");
					$.ajax({
						url: "attendance/studentlogout",
						data: {id:id},
						dataType: 'json',
						type: 'POST',
						success: function(d){
							console.log(d);
						},
						error: function(e){
							console.log(e);
						}
					});
				});
				//Viewing Class Record
				$("#view_student_grade").click(function(){
					$.ajax({
						url: "grade/viewclassrecord",
						data: {},
						type: 'GET',
						dataType: 'html',
						success: function(html){
							$("<li class='active'>View Class Record</li>").insertAfter($(".breadcrumb li"));
							$(".content .col-lg-12").html(html);
						},
						error: function(e){
							console.log(e);
						}
					});
				});

				//Individual Grading (per student)
				$(".student_set_grade").click(function(){
					var student_id = $(this).attr("s_id");
					var student_name = $(this).attr("s_name");
					$.ajax({
						url: "grade/studentgradeform",
						data: {id: student_id},
						type: 'GET',
						dataType: 'html',
						success: function(html){
							$("<li class='active'>Set Grade for <i><strong>" + student_name + "</strong></i></li>").insertAfter($(".breadcrumb li"));
							$(".content .col-lg-12").html(html);
							$(".select_grade_type").change(function(){							
								var id_g = $(this).find("option:selected").val();//ang ID sa gi select nga unsay graduhan

								$.ajax({
									url: "grade/studentgradingformload",
									data: {s_id: student_id,id_g: id_g},
									type: 'GET',
									dataType: 'html',
									success: function(html){
										$("#grading_form_content").html(html);
										//get and save grade
										$("#create_student_grade").click(function(){										
											$(".create_student_grade_form input").focus(function(){
												$(this).css("background-color","");
											});										
											
											var params = [];
											var error = false;
											$(".create_student_grade_form input").each(function(){
												var val = $(this).val();
												var ps_score = parseInt($(this).attr("ps_score"));
												var id = $(this).attr("id");							
												
												if(!(!isNaN(parseFloat(val)) && isFinite(val)) || val > ps_score || val < 1){
													$(this).css("background-color","#ff0000");
													error = true;
												}else{
													params.push({id:id,val:val});
												}
												
											});
											//submit the grades to DB
											if(!error){
												$.ajax({
													url: "grade/studentsavegrade",
													data: {data: params, student_id: student_id, id_g: id_g},
													type: 'POST',
													dataType: 'json',
													success: function(d){
														if(d.success){
															alert("Grade added successfully.");
															$(".swu_menutitle li").each(function(){
																if($(this).hasClass("active")){
																	loadthis($(this).find(":first-child"));
																}
															});
														}else{
															alert(d.message);
														}
													},
													error: function(e){
														console.log(e);
													}
												});
											}
										
										});
									},
									error: function(e){
										console.log(e);
									}
								});
							});
						}
					});
				});

				//Group Grading
				$(".group_set_grade").click(function(){
					var id = $(this).attr("group_id");
					var name = $(this).attr("group_name");
					$.ajax({
						url: "grade/groupgradeform",
						data: {id: id},
						type: 'GET',
						dataType: 'html',
						success: function(html){
							$("<li class='active'>" + name + " Grading</li>").insertAfter($(".breadcrumb li"));
							$(".content .col-lg-12").html(html);

							$(".select_grade_type").change(function(){
								var group_id = $(this).attr("group_id");//ang id sa group nga graduhan 
								var id_g = $(this).find("option:selected").val();//ang ID sa gi select nga unsay graduhan
								$.ajax({
									url: "grade/groupgradingformload",
									data: {gid: group_id,g: id_g},
									type: 'GET',
									dataType: 'html',
									success: function(html){
										$("#grading_form_content").html(html);

										$(".create_student_group_grade_form input").focus(function(){
											$(this).css("background-color","");
										});
										//get and save grade
										$("#create_student_group_grade").click(function(){
											var params = [];
											var error = false;
											$(".create_student_group_grade_form input").each(function(){
												var val = $(this).val();
												var ps_score = parseInt($(this).attr("ps_score"));
												var id = $(this).attr("id");							
												
												if(!(!isNaN(parseFloat(val)) && isFinite(val)) || val > ps_score || val < 1){
													$(this).css("background-color","#ff0000");
													error = true;
												}else{
													params.push({id:id,val:val});
												}
												
											});
											//submit the grades to DB
											if(!error){
												$.ajax({
													url: "grade/groupsavegrade",
													data: {data: params, group: group_id, g: id_g},
													type: 'POST',
													dataType: 'json',
													success: function(d){
														if(d.success){
															alert("Grade added successfully.");
															$(".swu_menutitle li").each(function(){
																if($(this).hasClass("active")){
																	loadthis($(this).find(":first-child"));
																}
															});
														}else{
															alert(d.message);
														}
													},
													error: function(e){
														console.log(e);
													}
												});
											}
										});
									},
									error: function(e){
										console.log(e);
									}
								});
							});
						},
						error: function(e){
							console.log(e);
						}
					});
				});
				//deleting deliveable
				$(".delete_deliverable").click(function(){
					var id = $(this).attr("d_id");
					$.ajax({
						url: "deliverable/deletedeliverable",
						data: {id: id},
						type: 'POST',
						dataType: 'json',
						success: function(d){
							if(d.success == 0){
								alert("Internal server error.");
							}else{
								$(".swu_menutitle li").each(function(){
									if($(this).hasClass("active")){
										loadthis($(this).find(":first-child"));
									}
								});
							}
						},
						error: function(e){
							console.log(e);
						}
					});
				});

				//view deliverable list from students
				$(".view_deliverable").click(function(){
					var id = $(this).attr("d_id");
					var desc = $(this).attr("d_desc");
					$.ajax({
						url: "deliverable/viewdeliverables",
						data:{id: id,description:desc},
						type: 'POST',
						dataType: 'html',
						success: function(html){
							$("<li class='active'>View Deliverable  /  " + desc + "</li>").insertAfter($(".breadcrumb li"));
							$(".content .col-lg-12").html(html);

							//approve deliverable
							$(".approve_deliverable").click(function(){
								var id = $(this).attr("d_id");
								$.ajax({
									url: "deliverable/approvedeliverable",
									data: {id:id},
									type: 'POST',
									dataType: 'json',
									success: function(d){									
										if(d.success == 0){
											alert(d.message);
										}else{
											$(".swu_menutitle li").each(function(){
												if($(this).hasClass("active")){
													loadthis($(this).find(":first-child"));
												}
											});
										}
									},
									error: function(e){
										console.log(e);
									}
								});
							});

							//Edit deliverable by Viewer
							$(".edit_deliverable").click(function(){
								var id = $(this).attr("d_id");
								$.ajax({
									url: "deliverable/paeditdeliverable",
									data: {id:id},
									type: 'GET',
									dataType: 'html',
									success: function(html){									
										$(".content .col-lg-12").html(html);
										$('#add_deliverable').click(function(e) {
											  e.preventDefault();
											  var notes = $("#notes").val();							  
											  var userfile = $("#userfile")[0].files[0];
											  
											  if(notes == undefined
											  	|| notes == ""
											  	|| userfile == undefined
											  	|| userfile == ""
											  	){
											  	alert("Fill in required fields.");
											  }else if(userfile.size > 20000000){
											  	alert("File limit exceeded.");
											  }else{
											  	 $.ajaxFileUpload({
											         url:'filemanagement/uploadstudentdeliverable/', 
											         secureuri:false,
											         fileElementId:'userfile',
											         dataType: 'json',
											         data: {notes: notes, d_id: id, isupdate: "yes"},
											         success: function (data, status){
											            if(data.status){
											            	alert(data.msg);
											            }else{
											            	alert("Upload Successful.");
											            	$(".swu_menutitle li").each(function(){
																if($(this).hasClass("active")){
																	loadthis($(this).find(":first-child"));
																}
															});
											            }
											         },
											         error: function(e){
											         	alert("There was an Error uploading your file, please try again later!");
											         }
											      });
											  }							
										     
										return false;
									   });
									},
									error: function(e){
										console.log(e);
									}
								});
							});
							//NOTES
							$(".modal-body").html("");
							$(".show_notes_deliverable").click(function(){
								var id = $(this).attr("d_id");
								$('#myModal').modal();
								$.ajax({
									url: "deliverable/viewdeliverablenotes",
									data: {id: id},
									type: 'GET',
									dataType: 'html',
									success: function(html){									
										$(".modal-body").html(html);
									}
								});
								$('#myModal').modal();
							});
						},
						error: function(e){
							console.log(e);
						}
					});
				});
				//editing deliverable by Adviser
				$(".edit_deliverable").click(function(){
					var id = $(this).attr("d_id");
					$.ajax({
						url: "deliverable/editdeliverableform",
						data: {id:id},
						type: 'POST',
						dataType: 'html',
						success: function(html){
							$("<li class='active'>Edit Deliverable</li>").insertAfter($(".breadcrumb li"));
							$(".content .col-lg-12").html(html);
							$('.submission_date').datepicker({
								format: "yyyy-mm-dd"
							})
							

							$("#submit_edit_deliverable").click(function(){
								var code = $("#code").val();
								var id = $("#id").val();
								var description = $("#description").val();
								var date = $("#submission_date").val();
								if(code == "" || description == ""){
									alert("Required fields.");
								}else{
									$.ajax({
										url: "deliverable/updatedeliverable",
										data: {
											id: id,
											code: code,
											description: description,
											date: date
										},
										type: 'POST',
										dataType: 'json',
										success: function(d){
											if(d.success == 0){
												alert(d.message);
											}else{
												$(".swu_menutitle li").each(function(){
													if($(this).hasClass("active")){
														loadthis($(this).find(":first-child"));
													}
												});
											}
										},
										error: function(e){
											console.log(e);
										}
									});
								}
							});
						},
						error: function(e){
							console.log(e);
						}
					})
				});
				//delete student
				$(".student_delete_user").click(function(){
					var id = $(this).attr("s_id");
					$.ajax({
						url: "account/studentdeleteuser",
						data: {id: id},
						type: 'POST',
						dataType: 'json',
						success: function(d){
							if(d.success == 0){
								alert("Internal server error.");
							}else{
								$(".swu_menutitle li").each(function(){
									if($(this).hasClass("active")){
										loadthis($(this).find(":first-child"));
									}
								});
							}
						},
						error: function(e){
							console.log(e);
						}
					});
				});
				//edit student account
				$(".edit_student_account").click(function(){
					var id = $(this).attr("s_id");
					$.ajax({
						url: "account/editstudentaccountform",
						type: "POST",
						dataType: "html",
						data: {id: id},
						success: function(html){
							$("<li class='active'>Edit Student Account</li>").insertAfter($(".breadcrumb li"));
							$(".content .col-lg-12").html(html);

							$("#edit_student_user").click(function(){
								var username = $("#username").val();
								var password = $("#password").val();
								var stud_group = ($("#group option:selected").val() != undefined) ? $("#group option:selected").val() : '';
								var name = $("#name").val();
								var id = $("#studentid").val();
								if(username == "" || password == "" || name == ""){
									alert("Please complete required fields.");
								}else{
									$.ajax({
										url: "account/updatestudentaccount",
										data: {
											username: username,
											password: password,
											stud_group: stud_group,
											name: name,
											id: id
										},
										type: 'POST',
										dataType: 'json',
										success: function(d){
											if(d.success == 0){
												alert(d.message);
												// $(".errormessagestud").removeClass("hide");
												// $(".errormessagestud").html(d.result.message);
											}else{
												$(".swu_menutitle li").each(function(){
													if($(this).hasClass("active")){
														loadthis($(this).find(":first-child"));
													}
												});
											}
										},
										error: function(e){
											console.log(e);
										}
									});
								}
							});
						},
						error: function(e){
							console.log(e);
						}
					});
				});	
				$("#create_user_admin").click(function(){
					$("<li class='active'>Create User</li>").insertAfter($(".breadcrumb li"));
					var url = "account/createuseradmin";
					$.ajax({
						url: url,
						data: {},
						dataType: "html",
						success: function(html){
							$(".content .col-lg-12").html(html);

							$("#create_user_by_admin").click(function(){
								var username = $("#username").val();
								var password = $("#password").val();
								var groupid = $("#group option:selected").val();
								var params = {
									username: username,
									password: password,
									groupid: groupid
								}
								if(username == "" || password == "" || !validateEmail(username)){
									alert("Missing field value.");
								}else{
									var url = "account/adduser";
									$.ajax({
										data: params,
										dataType: 'json',
										url: url,
										type: "POST",
										success: function(d){
											console.log(d.result)
											if(d.result.success == 0){
												$(".errormessage").removeClass("hide");
												$(".errormessage").html(d.result.message);
											}else{
												$(".swu_menutitle li").each(function(){
													if($(this).hasClass("active")){
														loadthis($(this).find(":first-child"));
													}
												});
											}
										},
										error: function(e){
											console.log("error");
										}
									});
								}
							});
						},
						error: function(e){
							console.log(e);
						}
					})
				});
				/*** EDIT ADMIN LIST of USER**/
				$(".admin_edit_user").click(function(){
					var id = $(this).attr("user_id");
					$.ajax({
						url: "account/editadminuser",
						data: {id: id},
						type: "GET",
						dataType: "html",
						success: function(html){
							$("<li class='active'>Update User</li>").insertAfter($(".breadcrumb li"));
							$(".content .col-lg-12").html(html);
							//udpate
							$("#update_user_by_admin").click(function(){
								var username = $("#username").val();
								var password = $("#password").val();
								var groupid = $("#group option:selected").val();
								var uid = $("#userid").val();
								$.ajax({
									url: "account/adminuserupdate",
									data: {
										username: username,
										password: password,
										groupid: groupid,
										userid: uid
									},
									type: "POST",
									dataType: 'json',
									success: function(d){
										if(d.success == 0){
											alert("Internal server error.");
										}else{
											$(".swu_menutitle li").each(function(){
												if($(this).hasClass("active")){
													loadthis($(this).find(":first-child"));
												}
											});
										}
									},
									error: function(e){
										alert("Internal server error.");
									}
								});
							});						
						}
					});
				});
				/*** ADMIN DELETE A USER **/
				$(".admin_delete_user").click(function(){
					var id = $(this).attr("user_id");
					$.ajax({
						url: "account/admindeleteuser",
						data: {id: id},
						type: 'POST',
						dataType: 'json',
						success: function(d){
							if(d.success == 0){
								alert("Internal server error.");
							}else{
								$(".swu_menutitle li").each(function(){
									if($(this).hasClass("active")){
										loadthis($(this).find(":first-child"));
									}
								});
							}
						},
						error: function(e){
							console.log(e);
						}
					});
				});
				/***  **/
				/*** START ADD Student Group*****/
				$("#add_student_group_btn").click(function(){
					$.ajax({
						url: 'account/addstudentgroup',
						type: 'GET',
						dataType: 'html',
						data: {},
						success: function(html){
							$("<li class='active'>Create Student Group</li>").insertAfter($(".breadcrumb li"));
							$(".content .col-lg-12").html(html);
							$("#create_student_group").click(function(){
								var name = $("#group_name").val();
								//send and create
								$.ajax({
									url: 'account/createstudentgroup',
									data: {name: name},
									dataType: 'json',
									type: 'POST',
									success: function(d){									
										$(".swu_menutitle li").each(function(){
											if($(this).hasClass("active")){
												loadthis($(this).find(":first-child"));
											}
										});	
									},
									error: function(e){
										console.log(e);
									}
								});
							});
						},
						error: function(e){
							console.log(e);
						}
					});
				});
				/*** END ADD Student Group*****/
				/*** Start adding a student account******/
				$("#add_student_btn").click(function(){
					$.ajax({
						url: 'account/addstudent',
						data: {},
						dataType: 'html',
						type: 'GET',
						success: function(html){
							$("<li class='active'>Create Student</li>").insertAfter($(".breadcrumb li"));
							$(".content .col-lg-12").html(html);
							$("#create_student_user").click(function(){
								var username = $("#username").val();
								var password = $("#password").val();
								var stud_group = ($("#group option:selected").val() != undefined) ? $("#group option:selected").val() : '';
								var name = $("#name").val();
								if(username == "" || password == "" || name == ""){
									alert("Please complete required fields.");
								}else{
									$.ajax({
										url: "account/createstudent",
										data: {
											username: username,
											password: password,
											stud_group: stud_group,
											name: name
										},
										type: 'POST',
										dataType: 'json',
										success: function(d){
											if(d.success == 0){
												$(".errormessagestud").removeClass("hide");
												$(".errormessagestud").html(d.result.message);
											}else{
												$(".swu_menutitle li").each(function(){
													if($(this).hasClass("active")){
														loadthis($(this).find(":first-child"));
													}
												});
											}
										},
										error: function(e){
											console.log(e);
										}
									});
								}
							});
						},
						error: function(e){
							console.log(e);
						}
					});
				});
				/*** END adding a student account******/
				/*** START adding Deliverable ********/
				$("#add_adviser_deliverable_btn").click(function(){
					$.ajax({
						url: "deliverable/adddeliverable",
						data: {},
						type: "GET",
						dataType: "html",
						success: function(html){
							$("<li class='active'>Create Deliverable</li>").insertAfter($(".breadcrumb li"));
							$(".content .col-lg-12").html(html);
							$('.submission_date').datepicker({
								format: "yyyy-mm-dd"
							})
							$("#create_deliverable").click(function(){
								var code = $("#code").val();
								var description = $("#description").val();
								var submission_date = $("#submission_date").val();
								if(code == "" || description == "" || submission_date == ""){
									console.log(code);
									console.log(description);
									console.log(submission_date);
									alert("Please complete all fields.");
								}else{
									var params = {
										code: code,
										submission_date: submission_date,
										description: description
									}
									$.ajax({
										url: 'deliverable/createdeliverable',
										data: params,
										type: "POST",
										dataType: 'json',
										success: function(d){
											if(d.success == 0){
												alert("Internal server error, try again later.")
											}else{
												$(".swu_menutitle li").each(function(){
													if($(this).hasClass("active")){
														loadthis($(this).find(":first-child"));
													}
												});
											}
										},
										error: function(e){
											console.log(e);
										}
									});
								}
							});						
						},
						error: function(e){
							console.log(e);
						}
					})
				});
				/*** END adding Deliverable ********/

				/**STUDENT ADD DELIVERABLE ***/
				$(".student_add_deliverable").click(function(){
					var id = $(this).attr("d_id");
					$.ajax({
						url: "filemanagement/uploaddeliverableform",
						data: {id: id},
						type: "GET",
						dataType: "html",
						success: function(html){
							$("<li class='active'>Add Deliverable</li>").insertAfter($(".breadcrumb li"));
							$(".content .col-lg-12").html(html);

							$('#add_deliverable').click(function(e) {
								  e.preventDefault();
								  var notes = $("#notes").val();							  
								  var userfile = $("#userfile")[0].files[0];
								  
								  if(notes == undefined
								  	|| notes == ""
								  	|| userfile == undefined
								  	|| userfile == ""
								  	){
								  	alert("Fill in required fields.");
								  }else if(userfile.size > 20000000){
								  	alert("File limit exceeded.");
								  }else{
								  	 $.ajaxFileUpload({
								         url:'filemanagement/uploadstudentdeliverable/', 
								         secureuri:false,
								         fileElementId:'userfile',
								         dataType: 'json',
								         data: {notes: notes, d_id: id},
								         success: function (data, status){
								            if(data.status){
								            	alert(data.msg);
								            }else{
								            	alert("Upload Successful.");
								            	$(".swu_menutitle li").each(function(){
													if($(this).hasClass("active")){
														loadthis($(this).find(":first-child"));
													}
												});
								            }
								         },
								         error: function(e){
								         	alert("There was an Error uploading your file, please try again later!");
								         }
								      });
								  }							
							     
							return false;
						   });
						},
						error: function(e){
							console.log(e);
						}
					});
				});
			},
			error: function(e){
				console.log("internal error");
			}
		});
	}
}

function validateEmail(email){
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}

logout = function(){
	$.ajax({
		url: 'logout',
		data: {},
		type: 'POST',
		success: function(d){
			window.location.href = "login";
		},
		error: function(e){
			console.log(e);
		}
	});
}