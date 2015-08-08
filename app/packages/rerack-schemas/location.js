Schema.address = new SimpleSchema({
  street: {
    type: String,
    max: 100
  },
  city: {
    type: String,
    max: 50
  },
  state: {
    type: String,
    regEx: /^A[LKSZRAEP]|C[AOT]|D[EC]|F[LM]|G[AU]|HI|I[ADLN]|K[SY]|LA|M[ADEHINOPST]|N[CDEHJMVY]|O[HKR]|P[ARW]|RI|S[CD]|T[NX]|UT|V[AIT]|W[AIVY]$/
  },
  zip: {
    type: String,
    regEx: /^[0-9]{5}$/
  }
});

Schema.coordinates = new SimpleSchema({
  longitude: {
    type: Number
  },
  latitude: {
    type: Number
  },
});

Schema.location = new SimpleSchema({
  creationDate: timestamp,
  name: {
    type: String,
    optional: true
  },
  address: {
    type: Schema.address
  },
  coordinates: {
    type: Schema.coordinates
  },
  creatorId: {
    type: String
  }
});
