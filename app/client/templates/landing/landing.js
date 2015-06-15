/*****************************************************************************/
/* Landing: Event Handlers and Helpersss .js*/
/*****************************************************************************/
Template.Landing.events({
  'click #email-submit': function (e, tmpl) {
    var email = tmpl.find('#email-input').value;
    var valid = tmpl.find('#invite-form').checkValidity();
    if (email != '' && valid) {
      e.preventDefault();
      Meteor.call('addInvite', email, function(error, result) {
        if (!error) {
          if (result) {
            $('#invite-form').slideUp();
          } else {

          }
        }
      });
    }
  },
  'change #email-input, keyup #email-input': function(e, tmpl) {
    var email = tmpl.find('#email-input').value;
    var valid = tmpl.find('#invite-form').checkValidity();
    if (valid) {
      Meteor.call('checkInviteEmail', email, function(error, result) {
        if (!error && result) {
          $('#invite-form').removeClass('valid');
          $('h4.in-use').show();
        } else {
          $('#invite-form').addClass('valid');
          $('h4.in-use').hide();
        }
      });
    }
  }
});

Template.Landing.helpers({
});

/*****************************************************************************/
/* Landing: Lifecycle Hooks */
/*****************************************************************************/
Template.Landing.created = function () {
};

Template.Landing.rendered = function () {
};

Template.Landing.destroyed = function () {
};