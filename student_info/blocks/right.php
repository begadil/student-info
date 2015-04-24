		<div id="sidebar-wrapper">
			
			<h3>Search by: </h3>
			
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				<div class="panel panel-info">
			    	<div class="panel-heading" role="tab" id="headingOne">
			      		<h4 class="panel-title">
			        		<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
			          			name or id
			        		</a>
			      		</h4>
			    	</div>
			    	<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
			      		<div class="panel-body">
			      			<div class="row">
			      				<div class="col-lg-1"></div>
			      				<form class="col-lg-9 form-horizontal" role="form">
									<div class="form-group">
										<input type="text" class="form-control" placeholder="enter name" id="search_name" onKeyUp="show_result()"/>
									</div>
									<div class="form-group">
										<input type="text" class="form-control" placeholder="enter surname" id="search_surname" onKeyUp="show_result()"/>
									</div>
								</form>
			      				<div class="col-lg-2"></div>
			      			</div>
			      		</div>
			    	</div>
			  	</div>
			  	
			  	<div class="panel panel-info">
			    	<div class="panel-heading" role="tab" id="headingTwo">
			      		<h4 class="panel-title">
			        		<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
			          			sdu info
			        		</a>
			      		</h4>
			    	</div>
			    	<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
			      		<div class="row">
			      			<div class="col-lg-1"></div>
			      			<form class="col-lg-9 form-horizontal" role="form">
								<div class="form-group">
									<input type="text" class="form-control" placeholder="enter sdu_id" id="search_sdu_id" onKeyUp="show_result()"/>
								</div>
							</form>
			      			<div class="col-lg-2"></div>
			      		</div>
			    	</div>
			  	</div>
			  	
			  	<div class="panel panel-info">
			    	<div class="panel-heading" role="tab" id="headingThree">
			      		<h4 class="panel-title">
			        		<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
			          			other info
			        		</a>
			      		</h4>
			    	</div>
			    	<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
			      		<div class="panel-body">
			      			some texts
			      		</div>
			    	</div>
			  	</div>
			</div>
		</div>