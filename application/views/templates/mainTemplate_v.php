<?php 
	$this->load->view('templates/includes/mainTemplateHead_v');
?>

<div id="content">
	<?php  $this->load->view($content); ?>
</div>

<?php 
	$this->load->view('templates/includes/mainTemplateFooter_v');
?>