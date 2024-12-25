Postman Collection
To facilitate testing these API endpoints in Postman, a Postman collection can be created containing all the routes listed above. Here's a brief structure of the collection:

User Registration:

POST /user/register (Register user and get token)
Category Routes (Requires token in Authorization header):

POST /api/category/create (Create new category)
Blog Routes (Requires token in Authorization header):

GET /api/blog/all (Get all blogs)
GET /api/blog/view/{id} (Get blog by ID)
POST /api/blog/create (Create a new blog)
PUT /api/blog/update/{id} (Update an existing blog)
DELETE /api/blog/delete/{id} (Delete a blog)
