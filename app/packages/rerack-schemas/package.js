Package.describe({
  name: "rerack:schemas",
  summary: "SimpleSchema definitions for Rerack.",
  version: "1.0.0",
  git: "https://github.com/platformthirteen/rerack/"
});

var where = ['client', 'server'];

Package.onUse(function (api) {
  api.versionsFrom('0.9.0');
  api.use('aldeed:simple-schema');
  api.imply('aldeed:simple-schema')

  api.addFiles('schema.js', where);
  api.addFiles('location.js', where);
  api.addFiles('table.js', where);

  api.export('Schema', where);
});
