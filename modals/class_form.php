<?php
session_start();
require_once(realpath(__DIR__ . '/../classes/actions.class.php'));
$actionClass = new Actions();
if (isset($_POST['id'])) {
  $class = $actionClass->get_class($_POST['id']);
  extract($class);
}
?>
<div class="form-container">
  <form id="class-form" method="POST">
    <input type="hidden" name="id" value="<?= $id ?? "" ?>">
    <div class="form-row">
      <div class="form-group">
        <label for="name">Class Name & Subject</label>
        <input type="text" id="name" name="name" value="<?= $name ?? "" ?>" required>
      </div>
    </div>
  </form>
</div>

<script>
  $('#class-form').submit(function(e) {
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
      </div>`);

    $.ajax({
      url: "ajax-api.php?action=save_class",
      method: "POST",
      data: _this.serialize(),
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
          if (resp?.msg != '') {
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