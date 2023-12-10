using System;
using System.Collections.Generic;
using System.Data;
using System.Data.Entity;
using System.Data.Entity.Infrastructure;
using System.Linq;
using System.Net;
using System.Net.Http;
using System.Web.Http;
using System.Web.Http.Cors;
using System.Web.Http.Description;
using API.Models;

namespace API.Controllers
{
    [EnableCors(origins: "*", headers: "*", methods: "*")] // tune to your needs
    [RoutePrefix("")]
    public class BOOKINGsController : ApiController
    {
        private Entities2 db = new Entities2();

        // GET: api/BOOKINGs
        public IQueryable<BOOKING> GetBOOKINGS()
        {
            db.Configuration.ProxyCreationEnabled = false;
            return db.BOOKINGS;
        }

        // GET: api/BOOKINGs/5
        [ResponseType(typeof(BOOKING))]
        public IHttpActionResult GetBOOKING(int id)
        {
            db.Configuration.ProxyCreationEnabled = false;

            BOOKING bOOKING = db.BOOKINGS.Find(id);
            if (bOOKING == null)
            {
                return NotFound();
            }

            return Ok(bOOKING);
        }

        // PUT: api/BOOKINGs/5
        [ResponseType(typeof(void))]
        public IHttpActionResult PutBOOKING(int id, BOOKING bOOKING)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            if (id != bOOKING.ID)
            {
                return BadRequest();
            }

            db.Entry(bOOKING).State = EntityState.Modified;

            try
            {
                db.SaveChanges();
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!BOOKINGExists(id))
                {
                    return NotFound();
                }
                else
                {
                    throw;
                }
            }

            return StatusCode(HttpStatusCode.NoContent);
        }

        // POST: api/BOOKINGs
        [ResponseType(typeof(BOOKING))]
        public IHttpActionResult PostBOOKING(BOOKING bOOKING)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            db.BOOKINGS.Add(bOOKING);

            try
            {
                db.SaveChanges();
            }
            catch (DbUpdateException)
            {
                if (BOOKINGExists(bOOKING.ID))
                {
                    return Conflict();
                }
                else
                {
                    throw;
                }
            }

            return CreatedAtRoute("DefaultApi", new { id = bOOKING.ID }, bOOKING);
        }

        // DELETE: api/BOOKINGs/5
        [ResponseType(typeof(BOOKING))]
        public IHttpActionResult DeleteBOOKING(int id)
        {
            BOOKING bOOKING = db.BOOKINGS.Find(id);
            if (bOOKING == null)
            {
                return NotFound();
            }

            db.BOOKINGS.Remove(bOOKING);
            db.SaveChanges();

            return Ok(bOOKING);
        }

        protected override void Dispose(bool disposing)
        {
            if (disposing)
            {
                db.Dispose();
            }
            base.Dispose(disposing);
        }

        private bool BOOKINGExists(int id)
        {
            return db.BOOKINGS.Count(e => e.ID == id) > 0;
        }
    }
}