<div class="container">

<h1>Datatype Builder</h1>

<?php echo $form_tag; ?>

  <!-- Package Information -->
  <fieldset>
    <legend>Package Information</legend>

    <div class="clearfix">
      <label for="pkg_title">Title</label>
      <div class="input"><input id="pkg_title" name="pkg_title" type="text" /></div>
    </div>

    <div class="clearfix">
      <label for="pkg_name">Short Name</label>
      <div class="input"><input id="pkg_name" name="pkg_name" type="text" /></div>
    </div>
  </fieldset>

  <!-- Datatype Information -->
  <fieldset>
    <legend>Datatype Information</legend>

    <div class="clearfix">
      <label for="class_title">Title</label>
      <div class="input"><input id="class_title" name="class_title" type="text" /></div>
    </div>

    <div class="clearfix">
      <label for="class_name">Short Name</label>
      <div class="input"><input id="class_name" name="class_name" type="text" /></div>
    </div>
  </fieldset>

  <!-- Datatype Properties -->
  <fieldset>
    <legend>Datatype Properties</legend>

    <table class="bordered-table condensed zebra-striped">
      <thead>
        <tr>
          <th scope="col">Title</th>
          <th scope="col">Short Name</th>
          <th scope="col">Datatype</th>
          <th scope="col">Default Value</th>
          <th class="roland_actions" scope="col">&nbsp;</th>
        </tr>
      </thead>

      <tbody class="roland">
        <tr class="roland_row">
          <td><input name="class_props[0][title]" type="text" /></td>
          <td><input name="class_props[0][name]" type="text" /></td>
          <td><input name="class_props[0][datatype]" type="text" /></td>
          <td><input name="class_props[0][default]" type="text" /></td>
          <td>
            <a class="add_row" title="Add row"><img src="/img/plus.png" /></a>
            <a class="remove_row" title="Remove row"><img src="/img/minus.png" /></a>
          </td>
        </tr>
      </tbody>
    </table>
  </fieldset>

  <!-- All done -->
  <div class="actions">
    <input class="btn large primary" type="submit" value="Create Package" />
    &nbsp;&nbsp;or&nbsp;&nbsp;
    <button class="btn" type="reset">Reset the form</button>
  </div>
</form>

</div>
