/*****************************************************************************/
/* Invites Methods */
/*****************************************************************************/

Meteor.methods({
 'addInvite': function (email) {
    return Invites.submitEmail(email);
 },
 'checkInviteEmail': function (email) {
    var i = Invites.findOne({email: email});
    return i != undefined;
 }
});