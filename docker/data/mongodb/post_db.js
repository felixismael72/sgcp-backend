db.createUser({
	user: "mongo",
	pwd: "12345678",
	roles: [
		{
			role: "readWrite",
			db: "post_db",
		},
	],
});
