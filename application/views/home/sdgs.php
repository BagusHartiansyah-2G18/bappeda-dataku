<!-- Content
============================================= -->
<section id="content">
	<div class="content-wrap">
		<div class="container clearfix">

			<div class="heading-block center py-0">
				<h3><?php echo $nama; ?></h3>
				<span><?php echo $sub_ttl; ?></span>
			</div>

			<!-- Post Content
			============================================= -->
			<div class="single-post nobottommargin clearfix">

				<!-- Posts
				============================================= -->
				<div id="posts" class="small-thumbs">
					<div class="entry clearfix">
						<div class="entry-image">
							<img class="image_fade" src="<?php echo base_url('uploads/sdgs/'.$gambar) ?>" alt="<?php echo $nama; ?>">
						</div>
						<div class="entry-content text-justify">
							<?php echo str_replace("\n", "<br>", $info); ?>
						</div>
					</div>
				</div>


				<div class="table-responsive">
					<table class="table table-bordered">
						<thead class="text-center bg-warning">
							<tr>
								<th rowspan="2" width="10" class="align-middle">Kode Indikator</th>
								<th rowspan="2" class="align-middle">Indikator</th>
								<th rowspan="2" class="align-middle">Sumber Data</th>
								<th rowspan="2" class="align-middle">Satuan</th>
								<th colspan="5" class="">Realisasi Pencapaian</th>
							</tr>
							<tr class="">
								<?php
									$tahun = date("Y"); 
								?>
								<th><?php echo ($tahun-4) ?></th>
								<th><?php echo ($tahun-3) ?></th>
								<th><?php echo ($tahun-2) ?></th>
								<th><?php echo ($tahun-1) ?></th>
								<th><?php echo ($tahun) ?></th>
							</tr>
						</thead>

						<tbody>
							<?php foreach ($target as $row) : ?>
							<!---  ========== DATA SDGS ========--->
							<tr>
								<td colspan="9" style="background: #E8F6FF">
									<?php echo $row['target'] ?>
								</td>
							</tr>

							<?php foreach ($row['sdgs_val'] as $val) : ?>
								<tr>
									<td><?php echo $val['kode'] ?></td>
									<td><?php echo $val['indikator'] ?></td>
									<td><?php echo $val['sumber'] ?></td>
									<td><?php echo $val['satuan'] ?></td>
									<td><?php echo $val['tahun1'] ?></td>
									<td><?php echo $val['tahun2'] ?></td>
									<td><?php echo $val['tahun3'] ?></td>
									<td><?php echo $val['tahun4'] ?></td>
									<td><?php echo $val['tahun5'] ?></td>
								</tr>
							<?php endforeach; ?>
							<!--- =========== END SDGS =======--->
							<?php endforeach; ?>
						</tbody>
					</table>

				</div>
			</div>
		</div>
	</div>
</section>
