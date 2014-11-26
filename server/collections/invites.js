/*
 * Add query methods like this:
 *  Invites.findPublic = function () {
 *    return Invites.find({is_public: true});
 *  }
 */

Invites.submitEmail = function(email) {
  email = email.toLowerCase();

  if (!Invites.findOne({email: email})) {
    console.log('email', email);
    Meteor.call('sendEmail', email)
    return email;
  }
}

Invites.allow({
  insert: function (userId, doc) {
    return true;
  },

  update: function (userId, doc, fieldNames, modifier) {
    return true;
  },

  remove: function (userId, doc) {
    return true;
  }
});

Invites.deny({
  insert: function (userId, doc) {
    return false;
  },

  update: function (userId, doc, fieldNames, modifier) {
    return false;
  },

  remove: function (userId, doc) {
    return false;
  }
});