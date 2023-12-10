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
    public class PASSENGERsController : ApiController
    {
        private Entities2 db = new Entities2();

        // GET: api/PASSENGERs
        public IQueryable<PASSENGER> GetPASSENGERS()
        {
            db.Configuration.ProxyCreationEnabled = false;

            return db.PASSENGERS;
        }

        // GET: api/PASSENGERs/5
        [ResponseType(typeof(PASSENGER))]
        public IHttpActionResult GetPASSENGER(int id)
        {
            db.Configuration.ProxyCreationEnabled = false;

            PASSENGER pASSENGER = db.PASSENGERS.Find(id);
            if (pASSENGER == null)
            {
                return NotFound();
            }

            return Ok(pASSENGER);
        }

        // PUT: api/PASSENGERs/5
        [ResponseType(typeof(void))]
        public IHttpActionResult PutPASSENGER(int id, PASSENGER pASSENGER)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            if (id != pASSENGER.ID)
            {
                return BadRequest();
            }

            db.Entry(pASSENGER).State = EntityState.Modified;

            try
            {
                db.SaveChanges();
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!PASSENGERExists(id))
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

        // POST: api/PASSENGERs
        [ResponseType(typeof(PASSENGER))]
        public IHttpActionResult PostPASSENGER(PASSENGER pASSENGER)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            db.PASSENGERS.Add(pASSENGER);

            try
            {
                db.SaveChanges();
            }
            catch (DbUpdateException)
            {
                if (PASSENGERExists(pASSENGER.ID))
                {
                    return Conflict();
                }
                else
                {
                    throw;
                }
            }

            return CreatedAtRoute("DefaultApi", new { id = pASSENGER.ID }, pASSENGER);
        }

        // DELETE: api/PASSENGERs/5
        [ResponseType(typeof(PASSENGER))]
        public IHttpActionResult DeletePASSENGER(int id)
        {
            PASSENGER pASSENGER = db.PASSENGERS.Find(id);
            if (pASSENGER == null)
            {
                return NotFound();
            }

            db.PASSENGERS.Remove(pASSENGER);
            db.SaveChanges();

            return Ok(pASSENGER);
        }

        protected override void Dispose(bool disposing)
        {
            if (disposing)
            {
                db.Dispose();
            }
            base.Dispose(disposing);
        }

        private bool PASSENGERExists(int id)
        {
            return db.PASSENGERS.Count(e => e.ID == id) > 0;
        }
    }
}