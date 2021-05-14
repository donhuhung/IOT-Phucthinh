using System;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Net.Http;
using System.Web.Http;
using WebApiDemo.Models;

namespace WebApiDemo.Controllers
{
    public class UsersController : ApiController
    {
        public IHttpActionResult GetAllUsers()
        {
            IList<UsersViewModel> usersViewModels = null;
            using(var x = new WebAPIEntities())
            {
                usersViewModels = x.Users.Select(c => new UsersViewModel()
                {
                    Id = c.id,
                    Name = c.name,
                    Email = c.email

                }).ToList<UsersViewModel>();

                if (usersViewModels.Count == 0)
                    return NotFound();

                return Ok(usersViewModels);
            }
        }


        public IHttpActionResult PostUser(UsersViewModel usersViewModel)
        {
            if (!ModelState.IsValid)
                return BadRequest("Invalid data");

            using (var x = new WebAPIEntities())
            {
                x.Users.Add(new User()
                {
                    name = usersViewModel.Name,
                    email = usersViewModel.Email
                });
                x.SaveChanges();
            }

            return Ok();
        }

    }
}
