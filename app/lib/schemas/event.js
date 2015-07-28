Schema.event = new SimpleSchema({
  name: {
    type: String,
    label: "Name",
    max: 100
  },
  date: {
    type: Date
  },
  locationID: {
    type: Number
  },
  visibility: {
    type: String,
    allowedValues: ['public', 'unlisted', 'private']
  },
  tables:{
    type: [Number]
  }
});
