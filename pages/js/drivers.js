$(function () {

    $("#input-search").on("keyup", function () {
      var rex = new RegExp($(this).val(), "i");
      $(".search-table .search-items:not(.header-item)").hide();
      $(".search-table .search-items:not(.header-item)")
        .filter(function () {
          return rex.test($(this).text());
        })
        .show();
    });

    $("#btn-add-contact").on("click", function (event) {

      // var $_username = document.getElementById("c-username");
      // $_username.value = "";
      //
      // var $_generatedpw = Math.floor(Math.random()*899999+100000);
      //
      // var $_password = document.getElementById("c-password");
      // $_password.value = $_generatedpw;
      //
      // var $_dpassword = document.getElementById("c-display-password");
      // $_dpassword.value = $_generatedpw;

      $("#addContactModal #btn-add").show();
      $("#addContactModal #btn-edit").hide();
      $("#addContactModal").modal("show");
    });


    function editContact() {
      $(".edit").on("click", function (event) {
        $("#addContactModal #btn-add").hide();
        $("#addContactModal #btn-edit").show();

        // Get Parents
        var getParentItem = $(this).parents(".search-items");
        var getModal = $("#addContactModal");

        // Get List Item Fields
        var $_name = getParentItem.find(".user-name");

        // Get Attributes
        var $_IdAttrValue = $_name.attr("data-id");
        var $_firstNameAttrValue = $_name.attr("data-firstName");
        var $_lastNameAttrValue = $_name.attr("data-lastName");
        var $_middleInitialAttrValue = $_name.attr("data-middleInitial");
        var $_addressAttrValue = $_name.attr("data-address");
        var $_birthdayAttrValue = $_name.attr("data-birthday");
        var $_licenseNumberAttrValue = $_name.attr("data-licenseNumber");
        var $_plateNumberAttrValue = $_name.attr("data-plateNumber");
        var $_colorAttrValue = $_name.attr("data-color");
        var $_brandAttrValue = $_name.attr("data-brand");
        var $_carModelAttrValue = $_name.attr("data-carModel");

        // Get Modal Attributes
        var $_getModalIdInput = getModal.find("#c-id");
        var $_getModalFirstNameInput = getModal.find("#c-firstName");
        var $_getModalLastNameInput = getModal.find("#c-lastName");
        var $_getModalmiddleInitialInput = getModal.find("#c-middleInitial");
        var $_getModaladdressInput = getModal.find("#c-address");
        var $_getModalbirthdayInput = getModal.find("#c-birthday");
        var $_getModallicenseNumberInput = getModal.find("#c-licenseNumber");
        var $_getModalplateNumberInput = getModal.find("#c-plateNumber");
        var $_getModalcolorInput = getModal.find("#c-color");
        var $_getModalbrandInput = getModal.find("#c-brand");
        var $_getModalcarModelInput = getModal.find("#c-carModel");

        // Set Modal Field's Value
        $_getModalIdInput.val($_IdAttrValue);
        $_getModalFirstNameInput.val($_firstNameAttrValue);
        $_getModalLastNameInput.val($_lastNameAttrValue);
        $_getModalmiddleInitialInput.val($_middleInitialAttrValue);
        $_getModaladdressInput.val($_addressAttrValue);
        $_getModalbirthdayInput.val($_birthdayAttrValue);
        $_getModallicenseNumberInput.val($_licenseNumberAttrValue);
        $_getModalplateNumberInput.val($_plateNumberAttrValue);
        $_getModalcolorInput.val($_colorAttrValue);
        $_getModalbrandInput.val($_brandAttrValue);
        $_getModalcarModelInput.val($_carModelAttrValue);

        $("#addContactModal").modal("show");
      });
    }

    editContact();

  });
