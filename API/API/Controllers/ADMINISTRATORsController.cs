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
    public class ADMINISTRATORsController : ApiController
    {
        private Entities2 db = new Entities2();

        // GET: api/ADMINISTRATORs
        public IQueryable<ADMINISTRATOR> GetADMINISTRATORS()
        {
            db.Configuration.ProxyCreationEnabled = false;

            return db.ADMINISTRATORS;
        }

        // GET: api/ADMINISTRATORs/5
        [ResponseType(typeof(ADMINISTRATOR))]
        public IHttpActionResult GetADMINISTRATOR(int id)
        {
            db.Configuration.ProxyCreationEnabled = false;

            ADMINISTRATOR aDMINISTRATOR = db.ADMINISTRATORS.Find(id);
            if (aDMINISTRATOR == null)
            {
                return NotFound();
            }

            return Ok(aDMINISTRATOR);
        }

        // PUT: api/ADMINISTRATORs/5
        [ResponseType(typeof(void))]
        public IHttpActionResult PutADMINISTRATOR(int id, ADMINISTRATOR aDMINISTRATOR)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            if (id != aDMINISTRATOR.ID)
            {
                return BadRequest();
            }

            db.Entry(aDMINISTRATOR).State = EntityState.Modified;

            try
            {
                db.SaveChanges();
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!ADMINISTRATORExists(id))
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

        // POST: api/ADMINISTRATORs
        [ResponseType(typeof(ADMINISTRATOR))]
        public IHttpActionResult PostADMINISTRATOR(ADMINISTRATOR aDMINISTRATOR)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            db.ADMINISTRATORS.Add(aDMINISTRATOR);

            try
            {
                db.SaveChanges();
            }
            catch (DbUpdateException)
            {
                if (ADMINISTRATORExists(aDMINISTRATOR.ID))
                {
                    return Conflict();
                }
                else
                {
                    throw;
                }
            }

            return CreatedAtRoute("DefaultApi", new { id = aDMINISTRATOR.ID }, aDMINISTRATOR);
        }

        // DELETE: api/ADMINISTRATORs/5
        [ResponseType(typeof(ADMINISTRATOR))]
        public IHttpActionResult DeleteADMINISTRATOR(int id)
        {
            ADMINISTRATOR aDMINISTRATOR = db.ADMINISTRATORS.Find(id);
            if (aDMINISTRATOR == null)
            {
                return NotFound();
            }

            db.ADMINISTRATORS.Remove(aDMINISTRATOR);
            db.SaveChanges();

            return Ok(aDMINISTRATOR);
        }

        protected override void Dispose(bool disposing)
        {
            if (disposing)
            {
                db.Dispose();
            }
            base.Dispose(disposing);
        }

        private bool ADMINISTRATORExists(int id)
        {
            return db.ADMINISTRATORS.Count(e => e.ID == id) > 0;
        }
    }
}