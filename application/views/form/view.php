


<div class="row">
    <div class="col-md-12">
      	<div class="panel panel-primary">
            <div class="panel-heading with-border">
              	<h3 class="panel-title">FORMULAIRE <?php echo mb_strtoupper($form['NAME']);?></h3>
            </div>
          	<div class="panel-body">
          		<div class="row clearfix">
                    <div class="col-md-12 disabled-form">
                        <div data-builder-json='<?php echo $obligation['FORM_DATA'];?>' id="fb-render"></div>	
                    </div>


                </div>
			</div>
			
			

          	<div class="box-footer">

          	</div>
            <input id="FORM_ID" name="FORM_ID" value="<?php echo $this->uri->segment(3); ?>" type="hidden"/> 
            <input id="FORM_OBLIGATION" name="FORM_OBLIGATION" value="<?php echo $this->uri->segment(4); ?>" type="hidden"/> 
            <input id="INTERNSHIP_ID" name="INTERNSHIP_ID" value="<?php echo $obligation['INTERNSHIP_ID']; ?>" type="hidden"/> 
      	</div>
    </div>
</div>

<style>
.formbuilder-signature-label{display:none;}
</style>




<style type="text/css" media="print">
    @page 
    {   

        size: auto;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */
    }
    .main-footer{display:none;}
</style>