<?php
global $wpdb;
if(isset($_GET['action']) && $_GET['action'] == 'wpfkr_deleteproducts'){
	wpfkrDeleteFakeProducts();
	wp_redirect("admin.php?page=wpfkr-products&tab=view_products&status=success");
}
$wpfkrQueryData = wpfkrGetFakeProductsList();
$wpfkrProductData = $wpfkrQueryData->posts;
//dcs_print($wpfkrQueryData);
$wpfkrActual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
 ?>
 <h2>Bellow are all the products generated by this plugin 
 	<?php if ( !empty($wpfkrProductData) ) { ?>
	 	<span class="deleteSpan">
	 		<a onclick="return confirm('Are you sure you want to delete all dummy products generated by this plugin?')" class="wpfkr-btn wpfkr-btnRed" href="<?=$wpfkrActual_link?>&action=wpfkr_deleteproducts">Delete dummy products</a>
	 	</span>
 	<?php } ?>
 </h2>
<table id="wpfkrListProductsTbl" class="stripe" style="width:100%">
	<thead>
		<tr>
			<th>#</th>
			<th>Product title</th>
			<th>Product Status</th>
			<th>Created date</th>
		</tr>
	</thead>
	<tbody>
		<?php
		if ( !empty($wpfkrProductData) ) {
			$counter = 1;
			foreach ($wpfkrProductData as $key => $productDatavalue){ ?>
				<tr>
					<td><?=$counter?></td>
					<td><?=$productDatavalue->post_title?></td>

					<td><?=$productDatavalue->post_status?></td>
					<td><?=date("F jS, Y", strtotime($productDatavalue->post_date));?></td>
				</tr>
				<?php
				$counter++;
			}
			wp_reset_postdata();
		} ?>
	</tbody>
</table>