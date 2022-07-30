db.createUser({
	user: "mongo",
	pwd: "12345678",
	roles: [
		{
			role: "readWrite",
			db: "scanif_db",
		},
	],
});
