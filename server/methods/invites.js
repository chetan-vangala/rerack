/*****************************************************************************/
/* Invites Methods */
/*****************************************************************************/

Meteor.methods({
 'addInvite': function (email) {
    return Invites.submitEmail(email);
 }
});