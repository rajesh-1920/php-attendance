<?php
session_start();
require_once(realpath(__DIR__ . '/../classes/actions.class.php'));
$actionClass = new Actions();
if (isset($_POST['id'])) {
  $student = $actionClass->get_student($_POST['id']);
  extract($student);
}
$classList = $actionClass->list_class();
?>
<div class="form-container">
  <form id="student-form" method="POST">
    <input type="hidden" name="id" value="<?= $id ?? "" ?>">

    <div class="form-group">
      <label for="class_id">Class Name & Subject</label>
      <select id="class_id" name="class_id" required>
        <option value="" <?= !isset($id) ? "selected" : "" ?> disabled>-- Select Class Here --</option>
        <?php if (!empty($classList) && is_array($classList)): ?>
          <?php foreach ($classList as $row): ?>
            <option value="<?= $row['id'] ?>" <?= (isset($class_id) && $class_id == $row['id']) ? "selected" : "" ?>>
              <?= $row['name'] ?>
            </option>
          <?php endforeach; ?>
        <?php endif; ?>
      </select>
    </div>

    <div class="form-group">
      <label for="name">Student Name</label>
      <input type="text" id="name" name="name" value="<?= $name ?? "" ?>" required>
    </div>
  </form>
</div>


<script>
  $('#student-form').submit(function(e) {
    e.preventDefault();
    var _this = $(this);
    start_loader();
    $(uniModal).find('.flashdata').remove();

    var flashData = $('<div>');
    flashData.addClass('flashdata');
    flashData.html(`
      <div class="flashdata-row">
        <div class="flashdata-msg"></div>
        <div class="flashdata-close-wrapper">
          <a href="javascript:void(0)" onclick="this.closest('.flashdata').remove()" class="flashdata-close">[x]</a>
        </div>
      </div>
    `);

    $.ajax({
      url: "ajax-api.php?action=save_student",
      method: "POST",
      data: $(this).serialize(),
      dataType: 'JSON',
      error: (err) => {
        flashData.find('.flashdata-msg').text(`An error occurred!`);
        flashData.addClass('flashdata-error');
        _this.prepend(flashData);
        end_loader();
        console.warn(err);
      },
      success: function(resp) {
        if (resp?.status === 'success') {
          location.reload();
        } else {
          if (resp?.msg !== '') {
            flashData.find('.flashdata-msg').text(resp.msg);
            flashData.addClass('flashdata-error');
            _this.prepend(flashData);
            end_loader();
          }
        }
      }
    });
  });
</script>