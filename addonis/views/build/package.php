<h1>Package Builder</h1>
<p>The Addonis package builder.</p>

<form>
  <!-- Package Information -->
  <fieldset>
    <legend>Package Information</legend>

    <div class="fld">
      <label for="pkg_name">Name</label>
      <input id="pkg_name" name="pkg_name" type="text" />
    </div>

    <div class="fld">
      <label for="pkg_short_name">Short Name</label>
      <input id="pkg_short_name" name="pkg_short_name" type="text" />
    </div>

    <div class="fld">
      <label for="pkg_description">Description</label>
      <input id="pkg_description" name="pkg_description" type="text" />
    </div>

    <div class="fld">
      <label for="pkg_version">Version</label>
      <input id="pkg_version" name="pkg_version" type="text" />
    </div>

    <div class="fld">
      <label for="pkg_license">License</label>
      <select id="pkg_license" name="pkg_license">
        <option value="client">Client</option>
        <option value="commercial">Commercial</option>
        <option value="free">Free</option>
      </select>
    </div>
  </fieldset>

  <!-- Accessory -->
  <fieldset>
    <legend>Accessory Information</legend>

    <div class="fld">
      <label><input id="acc_include" name="acc_include" type="checkbox"
        value="y" /> Include Accessory?</label>
    </div>
  </fieldset>

  <!-- Extension -->
  <fieldset>
    <legend>Extension Information</legend>

    <div class="fld">
      <label><input id="ext_include" name="ext_include" type="checkbox"
        value="y" /> Include Extension?</label>
    </div>
  </fieldset>

  <!-- Fieldtype -->
  <fieldset>
    <legend>Fieldtype Information</legend>

    <div class="fld">
      <label><input id="ft_include" name="ft_include" type="checkbox"
        value="y" /> Include Fieldtype?</label>
    </div>
  </fieldset>

  <!-- Module -->
  <fieldset>
    <legend>Module Information</legend>

    <div class="fld">
      <label><input id="mod_include" name="mod_include" type="checkbox"
        value="y" /> Include Module?</label>
    </div>

    <div class="fld">
      <label><input id="mod_cp" name="mod_cp" type="checkbox" value="y" />
        Module has control panel?</label>
    </div>

    <!-- Module : Actions -->
    <fieldset>
      <legend>ACTions</legend>

      <table>
        <thead>
          <tr>
          <th scope="col">Method</th>
          <th scope="col">Description</th>
          </tr>
        </thead>

        <tbody>
          <tr>
          <td><input name="mod_actions[0]['method']" type="text" /></td>
          <td><input name="mod_actions[0]['description']" type="text" /></td>
          </tr>
        </tbody>
      </table>
    </fieldset>

    <!-- Module : Template Tags -->
    <fieldset>
      <legend>Template Tags</legend>

      <table>
        <thead>
          <tr>
          <th scope="col">Name</th>
          <th scope="col">Description</th>
          </tr>
        </thead>

        <tbody>
          <tr>
          <td><input name="mod_tags[0]['name']" type="text" /></td>
          <td><input name="mod_tags[0]['description']" type="text" /></td>
          </tr>
        </tbody>
      </table>
    </fieldset>

  </fieldset>

  <!-- Plugin -->
  <fieldset>
    <legend>Plugin Information</legend>

    <div class="fld">
      <label><input id="pi_include" name="pi_include" type="checkbox"
        value="y" /> Include Plugin?</label>
    </div>
  </fieldset>

  <!-- Extras -->
  <fieldset>
    <legend>Extras</legend>

    <!-- Extras : Datatypes -->
    <fieldset>
      <legend>Datatypes</legend>

      <div class="fld">
        <label><input name="extras_datatypes[]" type="checkbox" value="ee_member_group" />
          EE Member Group</label>
      </div>
    </fieldset>

    <!-- Extras : Helpers -->
    <fieldset>
      <legend>Helpers</legend>

      <div class="fld">
        <label><input name="extras_helpers[]" type="checkbox" value="number" />
          Number</label>
      </div>
    </fieldset>

    <!-- Extras : Libraries -->
    <fieldset>
      <legend>Libraries</legend>

      <div class="fld">
        <label><input name="extras_libraries[]" type="checkbox" value="salesforce" />
          SalesForce</label>
      </div>
    </fieldset>
  </fieldset>

  <!-- All done -->
  <div class="fld fld_submit">
    <input type="submit" value="Create Package" />
    <i>or <input type="reset" value="Reset the form" /></i>
  </div>
</form>
