/*****************************************************************************/
/* Invites Publish Functions
/*****************************************************************************/

Meteor.publish('invites', function () {
  return Invites.find();
});