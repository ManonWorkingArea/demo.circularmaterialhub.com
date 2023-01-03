<div class="main-wrapper scrollspy-container">

	<div class="breadcrumb-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-8">
					<ol class="breadcrumb">
						<li><a href="#">หน้าหลัก</a></li>
						<li><a href="#">สมาชิก</a></li>
						<li class="active">ยืนยันบัญชีของคุณ</li>
					</ol>
				</div>
				<div class="col-xs-12 col-sm-4 hidden-xs">
					<p class="hot-line"> <i class="fa fa-phone"></i> Hot Line: 1-222-33658</p>
				</div>
			</div>
		</div>
	</div>
	
	<div class="container pt-60 pb-70">
		<div class="row">
			<div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
				<div class="confirmation-wrapper">
					<div class="confirmation-header">
						<form id="frm-confirm">
							<input id="code" name="code" type="hidden" value="<?php echo $data['confirm']['code']?>"> 
							<input id="key" name="key" type="hidden" value="<?php echo $data['confirm']['key']?>"> 
						</form>
						<div class="icon">
							<?php echo $data['return']['icon'];?>
						</div>
						<h2><?php echo $data['return']['title'];?></h2>
						<h5 class="text-uppercase text-muted">Thank you</h5>
						<p><?php echo $data['return']['msg'];?></p>
						
						<?php
							if($data['confirm']['status']=="1")
							{
								echo "<button class='btn btn-primary btn-md' onclick='confirm();'><i class='fa fa-check-circle' aria-hidden='true'></i> ยืนยันบัญชีของคุณ</button>";
							}
						?>
						
					</div>
				</div>
			</div>
		</div>
	</div>
	
</div>