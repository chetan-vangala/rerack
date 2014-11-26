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
        console.log(error, result);
      });
    }
  }
   
});

Template.Landing.helpers({
  /*
   * Example:
   *  items: function () {
   *    return Items.find();
   *  }
   */
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