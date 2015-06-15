Router.configure({
  layoutTemplate: 'MasterLayout',
  loadingTemplate: 'Loading',
  notFoundTemplate: 'NotFound'
});

Router.route('/', {
  name: 'landing',
  where: 'client'
});

Router.route('/find', {name: 'find'});
Router.route('/cast', {name: 'cast'});
