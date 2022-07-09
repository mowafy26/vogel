<?php
session_start();

include 'function_db.php';

//$url_going = 'https://2bdoctor.000webhostapp.com/back_end/';
//$url_going = 'back_end/';

    if(isset($_SESSION['user_delivery']) && $user['code_tager'] == 2){ ?>
    
<div class="container">
		<div class="main-body">
			<div class="row">
				<div class="col-xs-12">
					<div class="card">
						<div style="margin-top:20px;" class="card-body">
							<div class=" align-items-center text-center">
                                <h3 style="left: 0;font-size:14px;color:#ffce00" class="rate_title" >
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </h3>
<h3 style="right: 0;background: #0a79d7;border-radius: 15px 0px 0px 15px;" class="name_title" ><?php echo $user['name_tager']; ?></h3>
                                <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
								
                                <div class="mt-3">
									<p class="text-secondary mb-1">
                                        <?php echo $user['name_city'].' - '.$user['area_Name'] ?>
                                    </p>
									
                                    <p class="text-muted font-size-sm"><?php echo '0'.$user['phone_tager']; ?></p>
                                    <p><?php echo $user['adres_tager']; ?></p>
                    
								</div>
							</div>
                            <div style="padding:6px 9px;margin:20px" class="btn btn-info">
                                <i class="fa fa-edit"></i>
                            </div>
                            
						</div>
					</div>                    
				</div>
			</div>
		</div>
	</div>    
    
<?php } ?>