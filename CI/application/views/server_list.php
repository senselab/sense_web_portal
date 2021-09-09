<?php
	$this->load->helper('url');
?>
<html>
<head>
	<link href="<?=base_url()?>/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<script src="<?=base_url()?>/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?=base_url()?>/jq180.js"></script>
</head>
<body>
	<div class="container">
		<table border=1 width=800 class="table">
		<? foreach ($server_list as $i): ?>
			<tr>
				<th colspan=3>
					<table width=100% class="table">
						<tr class="info">
							<td width=20% id="<?=$i->id?>_ip" class="trig_update">ip:<?=$i->ip?></td>
							<td id="<?=$i->id?>_name" class="trig_update"><?= $i->name ?></td>
						</tr>
					</table>
				</th>
			<tr>
			<tr>
				<td width=5% id="<?=$i->id?>_kvm" class="trig_update " style="font-size:72px;"><?=$i->kvm?></td>
				<td width=70% id="<?=$i->id?>_comment" class="trig_update"><?=$i->comment?></td>
				<td>
					<table width="100%" class="table">

					<? foreach ($port_list[$i->id] as $j): ?>
						<tr style="background-color:#EFE;">
							<td width="45%" id="port_<?=$j->id?>_src" class="trig_port"> <?= $j->src_port ?> </td>
							<td width="45%" id="port_<?=$j->id?>_dst" class="trig_port"> <?= $j->dst_port ?> </td>
							<td width="10%" id="port_<?=$j->id?>_del" class="trig_port btn"> X </td>
						</tr>
					<?endforeach; ?>
						<tr>
							<td colspan=2 class="trig_add btn " id="add_<?=$i->id?>">add new entry</td>
						</tr>
					</table>
				</td>
			</tr>

		<?endforeach; ?>
		</table>

		<table width=800 class="table">
			<tr>
				<th> Port </th>
				<th> Target Server Name </th>
				<th> target Port </th>
			</tr>
			<? foreach ($used_port_list as $i): ?>
			<tr>
				<td><?=$i->dst_port?></td>
				<td><?=$server_list[$i->belong]->name?></td>
				<td><?=$i->src_port?></td>
			</tr>
			<?endforeach; ?>
		</table>
	</div>
	<script>
		//$("body").click(function(){alert("OK");});
		$(".trig_add").click(function()
		{
			info = $(this).attr("id").split("_");
			$.post("<?=current_url()?>/add", {belong:info[1]},function(data)
			{
				//alert(info[1]);
				location.reload();
			});
		});
		$(".trig_port").dblclick(function()
		{

			info = $(this).attr("id").split("_");
			//alert(info);
			ori = $(this);
			if (info[2] == "del")
			{
				
				$.post("<?=current_url()?>/remove", {id:info[1]},function(data)
				{
					//alert(data);
					location.reload();
				});
				return;
			}
			$(this).html("<input id=\"dynamic_input\" value=" + $(this).text()+" />");
			$("#dynamic_input").focus();
			$("#dynamic_input").blur(function()
			{
				//alert($(this).val());
				tmp = $(this).val();
				$.post("<?=current_url()?>/update", {type:info[2], target:info[1], val:$(this).val()},function(data)
				{
					//alert(data);
					ori.html(tmp);
				});
			});
		});
		$(".trig_update").dblclick(function()
		{
			info = $(this).attr("id").split("_");
			//alert(info);
			ori = $(this);

			$(this).html("<input id=\"dynamic_input\" value=" + $(this).text()+" />");
			$("#dynamic_input").focus();
			$("#dynamic_input").blur(function()
			{
				tmp = $(this).val();
				$.post("<?=current_url()?>/update_general", {id:info[0], target:info[1], val:$(this).val()},function(data)
				{
					//alert(data);
					ori.html(tmp);
				});
			});
		});
	</script>
</body>
</html>