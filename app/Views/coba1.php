  <div class="form-group">
      <label>Pemilik Project <span class="req">*</span></label>
      <select name="pemilik_projek_id" required class="w-full min-h-[46px] px-4 py-3 text-sm border border-[#e3e8ee] rounded-lg text-[#3b4754] bg-white focus:border-primary-500 outline-none">
          <option value="">— Pilih —</option>
          <?php foreach ($pemilik_projek as $row): ?>
              <option value="<?= $row['id'] ?>"><?= esc($row['nama_pemilik']) ?></option>
          <?php endforeach; ?>
      </select>
  </div>
  <div class="form-group">
      <label>DC <span class="req">*</span></label>
      <select name="nama_dc_id" required class="w-full min-h-[46px] px-4 py-3 text-sm border border-[#e3e8ee] rounded-lg text-[#3b4754] bg-white focus:border-primary-500 outline-none">
          <option value="">— Pilih —</option>
          <?php foreach ($dc as $row): ?>
              <option value="<?= $row['id'] ?>"><?= esc($row['nama_dc']) ?></option>
          <?php endforeach; ?>
      </select>
  </div>
  <div class="form-group">
      <label>Media Koneksi <span class="req">*</span></label>
      <select name="media_koneksi_id" required class="w-full min-h-[46px] px-4 py-3 text-sm border border-[#e3e8ee] rounded-lg text-[#3b4754] bg-white focus:border-primary-500 outline-none">
          <option value="">— Pilih —</option>
          <?php foreach ($media as $row): ?>
              <option value="<?= $row['id'] ?>"><?= esc($row['media_koneksi']) ?></option>
          <?php endforeach; ?>
      </select>
  </div>

  <div class="form-group">
      <label>Pemilik Project <span class="req">*</span></label>
      <select name="pemilik_projek_id" required class="w-full min-h-[46px] px-4 py-3 text-sm border border-[#e3e8ee] rounded-lg text-[#3b4754] bg-white focus:border-primary-500 outline-none">
          <option value="">— Pilih —</option>
          <?php foreach ($pemilik_projek as $row): ?>
              <option value="<?= $row['id'] ?>"
                  <?= $midi['pemilik_projek_id'] == $row['id'] ? 'selected' : '' ?>>
                  <?= esc($row['nama_pemilik']) ?>
              </option>
          <?php endforeach; ?>
      </select>
  </div>
  <div class="form-group">
      <label>DC <span class="req">*</span></label>
      <select name="nama_dc_id" required class="w-full min-h-[46px] px-4 py-3 text-sm border border-[#e3e8ee] rounded-lg text-[#3b4754] bg-white focus:border-primary-500 outline-none">
          <option value="">— Pilih —</option>
          <?php foreach ($dc as $row): ?>
              <option value="<?= $row['id'] ?>"
                  <?= $midi['nama_dc_id'] == $row['id'] ? 'selected' : '' ?>>
                  <?= esc($row['nama_dc']) ?>
              </option>
          <?php endforeach; ?>
      </select>
  </div>
  <div class="form-group">
      <label>Media Koneksi <span class="req">*</span></label>
      <select name="media_koneksi_id" required class="w-full min-h-[46px] px-4 py-3 text-sm border border-[#e3e8ee] rounded-lg text-[#3b4754] bg-white focus:border-primary-500 outline-none">
          <option value="">— Pilih —</option>
          <?php foreach ($media as $row): ?>
              <option value="<?= $row['id'] ?>"
                  <?= $midi['media_koneksi_id'] == $row['id'] ? 'selected' : '' ?>>
                  <?= esc($row['media_koneksi']) ?>
              </option>
          <?php endforeach; ?>
      </select>
  </div>


  <div class="form-group">
      <label>Jenis Perangkat <span class="req">*</span></label>
      <select name="jenis_perangkat_id" required class="w-full min-h-[46px] px-4 py-3 text-sm border border-[#e3e8ee] rounded-lg text-[#3b4754] bg-white focus:border-primary-500 outline-none">
          <option value="">— Pilih —</option>
          <?php foreach ($jenis as $row): ?>
              <option value="<?= $row['id'] ?>"
                  <?= $midi['jenis_perangkat_id'] == $row['id'] ? 'selected' : '' ?>>
                  <?= esc($row['jenis_perangkat']) ?>
              </option>
          <?php endforeach; ?>
      </select>
  </div>
  <div class="form-group">
      <label>Merk Perangkat <span class="req">*</span></label>
      <select name="merk_perangkat_id" id="merk_perangkat_select" required class="w-full min-h-[46px] px-4 py-3 text-sm border border-[#e3e8ee] rounded-lg text-[#3b4754] bg-white focus:border-primary-500 outline-none">
          <option value="">— Pilih —</option>
          <?php foreach ($perangkat as $row): ?>
              <option value="<?= $row['id'] ?>" <?= $midi['merk_perangkat_id'] == $row['id'] ? 'selected' : '' ?>>
                  <?= esc($row['merk_perangkat']) ?>
              </option>
          <?php endforeach; ?>
      </select>
  </div>
  <div class="form-group">
      <label>Type Perangkat <span class="req">*</span></label>
      <select name="type_perangkat" id="type_perangkat_select" required class="w-full min-h-[46px] px-4 py-3 text-sm border border-[#e3e8ee] rounded-lg text-[#3b4754] bg-white focus:border-primary-500 outline-none">
          <option value="">— Pilih —</option>
      </select>
  </div>