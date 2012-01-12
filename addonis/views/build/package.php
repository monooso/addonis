<div class="container">

<h1>Package Builder</h1>

<form>
  <!-- Package Information -->
  <fieldset>
    <legend>Package Information</legend>

    <div class="clearfix">
      <label for="pkg_name">Name</label>
      <div class="input"><input id="pkg_name" name="pkg_name" type="text" /></div>
    </div>

    <div class="clearfix">
      <label for="pkg_short_name">Short Name</label>
      <div class="input"><input id="pkg_short_name" name="pkg_short_name" type="text" /></div>
    </div>

    <div class="clearfix">
      <label for="pkg_description">Description</label>
      <div class="input"><input id="pkg_description" name="pkg_description" type="text" /></div>
    </div>

    <div class="clearfix">
      <label for="pkg_version">Version</label>
      <div class="input"><input id="pkg_version" name="pkg_version" type="text" /></div>
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
      <label for="acc_include">Include Accessory?</label>
      <div class="input">
        <select id="acc_include" name="acc_include">
          <option value="y">Yes</option>
          <option selected="selected" value="n">No</option>
        </select>
      </div>
    </div>

    <div class="clearfix">
      <label for="ext_include">Include Extension?</label>
      <div class="input">
        <select id="ext_include" name="ext_include">
          <option value="y">Yes</option>
          <option selected="selected" value="n">No</option>
        </select>
      </div>
    </div>

    <div class="clearfix">
      <label for="ft_include">Include Fieldtype?</label>
      <div class="input">
        <select id="ft_include" name="ft_include">
          <option value="y">Yes</option>
          <option selected="selected" value="n">No</option>
        </select>
      </div>
    </div>

    <div class="clearfix">
      <label for="mod_include">Include Module?</label>
      <div class="input">
        <select id="mod_include" name="mod_include">
          <option value="y">Yes</option>
          <option selected="selected" value="n">No</option>
        </select>
      </div>
    </div>

    <div class="clearfix">
      <label for="pi_include">Include Plugin?</label>
      <div class="input">
        <select id="pi_include" name="pi_include">
          <option value="y">Yes</option>
          <option selected="selected" value="n">No</option>
        </select>
      </div>
    </div>
  </fieldset>

  <hr />

  <!-- Accessory -->
  <fieldset>
    <legend>Accessory Information</legend>
  </fieldset>

  <hr />

  <!-- Extension -->
  <fieldset>
    <legend>Extension Information</legend>
  </fieldset>

  <hr />

  <!-- Fieldtype -->
  <fieldset>
    <legend>Fieldtype Information</legend>
  </fieldset>

  <hr />

  <!-- Module -->
  <fieldset>
    <legend>Module Information</legend>

    <div class="clearfix">
      <label for="mod_cp">Module has Control Panel?</label>
      <div class="input">
        <select id="mod_cp" name="mod_cp">
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
            <th scope="col">&nbsp;</th>
            <th scope="col">Method</th>
            <th scope="col">Description</th>
            </tr>
          </thead>

          <tbody>
            <tr>
            <td>+ / -</td>
            <td><input name="mod_actions[0]['method']" type="text" /></td>
            <td><input name="mod_actions[0]['description']" type="text" /></td>
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
            <th scope="col">&nbsp;</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            </tr>
          </thead>

          <tbody>
            <tr>
            <td>+ / -</td>
            <td><input name="mod_tags[0]['name']" type="text" /></td>
            <td><input name="mod_tags[0]['description']" type="text" /></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </fieldset>

  <hr />

  <!-- Plugin -->
  <fieldset>
    <legend>Plugin Information</legend>
  </fieldset>

  <hr />

  <!-- Extras -->
  <fieldset>
    <legend>Extras</legend>

    <!-- Extras : Datatypes -->
    <div class="clearfix">
      <label for="extras_datatypes">Datatypes</label>
      <div class="input">
        <ul class="inputs-list">
          <li>
            <label><input name="extras_datatypes" type="checkbox" value="ee_member" />
              <span>EE Member</span></label>
          </li>
          <li>
            <label><input name="extras_datatypes" type="checkbox" value="ee_member_group" />
              <span>EE Member Group</span></label>
          </li>
        </ul>
      </div>
    </div>

    <!-- Extras : Helpers -->
    <div class="clearfix">
      <label for="extras_helpers">Helpers</label>
      <div class="input">
        <ul class="inputs-list">
          <li>
            <label><input name="extras_helpers" type="checkbox" value="number" />
              <span>Number</span></label>
          </li>
        </ul>
      </div>
    </div>

    <!-- Extras : Libraries -->
    <div class="clearfix">
      <label for="extras_libs">Libraries</label>
      <div class="input">
        <ul class="inputs-list">
          <li>
            <label><input name="extras_libs" type="checkbox" value="salesforce" />
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
