<div class="main-container">
	<div class="xs-pd-20-10 pd-ltr-20">
		<div class="pd-20 card-box mb-30">
			<div class="clearfix mb-20">
				<div class="pull-left">
					<h4 class="text-blue h4">Laporan Bulanan</h4>

				</div>
				<div class="pull-right">

				</div>
			</div>
			<?php if ($this->session->flashdata('msg')) { ?>
				<?= $this->session->flashdata('msg') ?>
			<?php } ?>
			<form action="<?= site_url('C_Laporan/filter') ?>" method="post">
				<div class="mb-3">
					<label for="exampleFormControlInput1" class="form-label">Pilih Bulan</label>
					<input type="date" name="cucimobil_tanggal" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
				</div>
				<input type="submit" value="Filter" name="submit" class="btn btn-primary">
			</form>
			<!-- Button trigger modal -->
			<button type="button" class="btn btn-success mt-2" data-toggle="modal" data-target="#exampleModalCenter">
				Cetak Laporan
			</button>

			<!-- Modal -->
			<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLongTitle">Cetak Laporan Transaksi</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form action="<?= site_url('C_Laporan/cetaklaporan') ?>" method="post">
								<div class="row">
									<div class="col">
										<label for="formGroupExampleInput">Periode Awal</label>
										<input type="date" name="date_1" class="form-control" placeholder="First name">
									</div>
									<div class="col">
										<label for="formGroupExampleInput">Periode Akhir</label>
										<input type="date" name="date_2" class="form-control" placeholder="Last name">
									</div>
								</div>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<input type="submit" class="btn btn-primary" name="submit" value="Cetak Laporan">
							</form>
						</div>

					</div>
				</div>
			</div>

			<table class="table mt-5">
				<thead>
					<tr>
						<th scope="col">No</th>
						<th scope="col">ID Transaksi</th>
						<th scope="col">Tanggal</th>
						<th scope="col">Nama Pelanggan</th>
						<th scope="col">Jenis Kendaraan</th>
						<th scope="col">Nomor Plat</th>
						<th scope="col">Jenis Paket</th>
						<th scope="col">Harga</th>
						<th scope="col" colspan="2">Action</th>
					</tr>
				</thead>
				<tbody>

					<?php $i = 1;
					foreach ($cucimobil as $cuci) { ?>
						<tr>
							<td><?= $i++ ?></td>
							<td><?= $cuci->cucimobil_idtransaksi ?></td>
							<td><?= $cuci->cucimobil_tanggal ?></td>
							<td><?= $cuci->cucimobil_nama ?></td>
							<td><?= $cuci->cucimobil_tipe ?></td>
							<td><?= $cuci->cucimobil_plat ?></td>
							<td><?= $cuci->paket_nama ?></td>
							<td>Rp. <?= $cuci->paket_harga++ ?></td>

							<td><a href="<?= site_url('C_Cucimobil/delete/' . $cuci->cucimobil_id) ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a></td>
						</tr><?php } ?>
					<tr>
						<td colspan="6">Total</td>
						<?php foreach ($total as $total) { ?>
							<td colspan="3" style="text-align: center;">Rp. <?= $total->paket_harga ?></td>
						<?php } ?>
					</tr>


				</tbody>
			</table>

		</div>
		<div class="collapse collapse-box" id="basic-table">
			<div class="code-box">
				<div class="clearfix">

				</div>
				<pre><code class="xml copy-pre" id="basic-table-code">
							</code></pre>
			</div>
		</div>
	</div>
</div>
</div>


<html>