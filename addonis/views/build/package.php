<div class="container">

<h1>Package Builder</h1>

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

    <div class="clearfix">
      <label for="pkg_description">Description</label>
      <div class="input"><input id="pkg_description" name="pkg_description" type="text" /></div>
    </div>

    <div class="clearfix">
      <label for="pkg_version">Version</label>
      <div class="input"><input id="pkg_version" name="pkg_version" type="text" value="0.1.0" /></div>
    </div>

    <div class="clearfix">
      <label for="pkg_license">License</label>
      <div class="input">
        <select id="pkg_license" name="pkg_license">
          <option value="client">Client</option>
          <option value="commercial">Commercial</option>
          <option value="free">Free</option>
        </select>
      </div>
    </div>

    <div class="clearfix">
      <label for="pkg_include_acc">Include Accessory?</label>
      <div class="input">
        <select id="pkg_include_acc" name="pkg_include_acc">
          <option value="y">Yes</option>
          <option selected="selected" value="n">No</option>
        </select>
      </div>
    </div>

    <div class="clearfix">
      <label for="pkg_include_ext">Include Extension?</label>
      <div class="input">
        <select id="pkg_include_ext" name="pkg_include_ext">
          <option value="y">Yes</option>
          <option selected="selected" value="n">No</option>
        </select>
      </div>
    </div>

    <div class="clearfix">
      <label for="pkg_include_ft">Include Fieldtype?</label>
      <div class="input">
        <select id="pkg_include_ft" name="pkg_include_ft">
          <option value="y">Yes</option>
          <option selected="selected" value="n">No</option>
        </select>
      </div>
    </div>

    <div class="clearfix">
      <label for="pkg_include_mod">Include Module?</label>
      <div class="input">
        <select id="pkg_include_mod" name="pkg_include_mod">
          <option value="y">Yes</option>
          <option selected="selected" value="n">No</option>
        </select>
      </div>
    </div>

    <div class="clearfix">
      <label for="pkg_include_pi">Include Plugin?</label>
      <div class="input">
        <select id="pkg_include_pi" name="pkg_include_pi">
          <option value="y">Yes</option>
          <option selected="selected" value="n">No</option>
        </select>
      </div>
    </div>
  </fieldset>

  <!-- Accessory -->
  <fieldset class="addon_type" id="acc_details">
    <legend>Accessory Information</legend>

    <!-- Accessory : Sections -->
    <div class="clearfix">
      <label>Sections</label>

      <div class="input">
        <table class="bordered-table condensed zebra-striped">
          <thead>
            <tr>
            <th scope="col">Title</th>
            <th scope="col">Short Name</th>
            <th class="roland_actions" scope="col">&nbsp;</th>
            </tr>
          </thead>

          <tbody class="roland">
            <tr class="roland_row">
              <td><input name="acc_sections[0][title]" type="text" /></td>
              <td><input name="acc_sections[0][name]" type="text" /></td>
              <td>
                <a class="add_row" title="Add row"><img src="/img/plus.png" /></a>
                <a class="remove_row" title="Remove row"><img src="/img/minus.png" /></a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </fieldset>

  <!-- Extension -->
  <fieldset class="addon_type" id="ext_details">
    <legend>Extension Information</legend>
  </fieldset>

  <!-- Fieldtype -->
  <fieldset class="addon_type" id="ft_details">
    <legend>Fieldtype Information</legend>
  </fieldset>

  <!-- Module -->
  <fieldset class="addon_type" id="mod_details">
    <legend>Module Information</legend>

    <div class="clearfix">
      <label for="mod_has_cp">Has Control Panel?</label>
      <div class="input">
        <select id="mod_has_cp" name="mod_has_cp">
          <option selected="selected" value="y">Yes</option>
          <option value="n">No</option>
        </select>
      </div>
    </div>

    <!-- Module : Actions -->
    <div class="clearfix">
      <label>Actions</label>

      <div class="input">
        <table class="bordered-table condensed zebra-striped">
          <thead>
            <tr>
              <th scope="col">Method</th>
              <th scope="col">Description</th>
              <th class="roland_actions" scope="col">&nbsp;</th>
            </tr>
          </thead>

          <tbody class="roland">
            <tr class="roland_row">
              <td><input name="mod_actions[0][method]" type="text" /></td>
              <td><input name="mod_actions[0][description]" type="text" /></td>
              <td>
                <a class="add_row" title="Add row"><img src="/img/plus.png" /></a>
                <a class="remove_row" title="Remove row"><img src="/img/minus.png" /></a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Module : Template Tags -->
    <div class="clearfix">
      <label>Template Tags</label>

      <div class="input">
        <table class="bordered-table condensed zebra-striped">
          <thead>
            <tr>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th class="roland_actions" scope="col">&nbsp;</th>
            </tr>
          </thead>

          <tbody class="roland">
            <tr class="roland_row">
              <td><input name="mod_tags[0][name]" type="text" /></td>
              <td><input name="mod_tags[0][description]" type="text" /></td>
              <td>
                <a class="add_row" title="Add row"><img src="/img/plus.png" /></a>
                <a class="remove_row" title="Remove row"><img src="/img/minus.png" /></a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Module : CP Pages -->
    <div class="clearfix">
      <label>Control Panel Pages</label>

      <div class="input">
        <table class="bordered-table condensed zebra-striped">
          <thead>
            <tr>
            <th scope="col">Title</th>
            <th scope="col">Short Name</th>
            <th class="roland_actions" scope="col">&nbsp;</th>
            </tr>
          </thead>

          <tbody class="roland">
            <tr class="roland_row">
              <td><input name="mod_cp_pages[0][title]" type="text" /></td>
              <td><input name="mod_cp_pages[0][name]" type="text" /></td>
              <td>
                <a class="add_row" title="Add row"><img src="/img/plus.png" /></a>
                <a class="remove_row" title="Remove row"><img src="/img/minus.png" /></a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </fieldset>

  <!-- Plugin -->
  <fieldset class="addon_type" id="pi_details">
    <legend>Plugin Information</legend>

    <!-- Plugin : Template Tags -->
    <div class="clearfix">
      <label>Template Tags</label>

      <div class="input">
        <table class="bordered-table condensed zebra-striped">
          <thead>
            <tr>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th class="roland_actions" scope="col">&nbsp;</th>
            </tr>
          </thead>

          <tbody class="roland">
            <tr class="roland_row">
              <td><input name="pi_tags[0][name]" type="text" /></td>
              <td><input name="pi_tags[0][description]" type="text" /></td>
              <td>
                <a class="add_row" title="Add row"><img src="/img/plus.png" /></a>
                <a class="remove_row" title="Remove row"><img src="/img/minus.png" /></a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </fieldset>

  <!-- Extras -->
  <fieldset>
    <legend>Extras</legend>

    <!-- Extras : Datatypes -->
    <div class="clearfix">
      <label for="datatypes">Datatypes</label>
      <div class="input">
        <ul class="inputs-list">
          <li>
            <label><input name="datatypes" type="checkbox" value="ee_member" />
              <span>EE Member</span></label>
          </li>
          <li>
            <label><input name="datatypes" type="checkbox" value="ee_member_group" />
              <span>EE Member Group</span></label>
          </li>
        </ul>
      </div>
    </div>

    <!-- Extras : Helpers -->
    <div class="clearfix">
      <label for="helpers">Helpers</label>
      <div class="input">
        <ul class="inputs-list">
          <li>
            <label><input name="helpers[]" type="checkbox" value="EI_number_helper" />
              <span>EI Number Helper</span></label>
          </li>
        </ul>
      </div>
    </div>

    <!-- Extras : Libraries -->
    <div class="clearfix">
      <label for="libraries">Libraries</label>
      <div class="input">
        <ul class="inputs-list">
          <li>
            <label><input name="libraries" type="checkbox" value="salesforce" />
              <span>SalesForce</span></label>
          </li>
        </ul>
      </div>
    </div>
  </fieldset>

  <!-- All done -->
  <div class="actions">
    <input class="btn large primary" type="submit" value="Create Package" />
    &nbsp;&nbsp;or&nbsp;&nbsp;
    <button class="btn" type="reset">Reset the form</button>
  </div>
</form>

</div>
