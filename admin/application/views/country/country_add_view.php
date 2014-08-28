<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Manage Country</h1>
					</div>
					<div class="pull-right">
						<ul class="minitiles">
							<li class='grey'>
								
							</li>
							<li class='lightgrey'>
								
							</li>
						</ul>
						<ul class="stats">
							
							<li class='lightred'>
								<i class="icon-calendar"></i>
								<div class="details">
									<span class="big">February 22, 2013</span>
									<span>Wednesday, 13:56</span>
								</div>
							</li>
						</ul>
					</div>
				</div>
				
				<div class="box box-color box-bordered red">
							<div class="box-title">
								<h3>
									<i class="icon-ok"></i> Add a new country
								</h3>
                              
							</div>
							<div class="box-content">
<?php
$this->load->helper('form');
echo form_open('country/save');
echo form_fieldset('Add a new country');
echo form_label('Country Name: ');
echo form_input('country_name', '');
echo form_label('Country Phone Code');
echo form_input('country_phonecode', '');
echo form_label();
echo form_submit('save','Add', 'class="btn btn-primary"');
echo form_fieldset_close();
echo form_close();
?>
							</div>
						</div>
				
			</div>
			

