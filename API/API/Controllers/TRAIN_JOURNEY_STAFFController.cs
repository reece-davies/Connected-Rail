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
    public class TRAIN_JOURNEY_STAFFController : ApiController
    {
        private Entities2 db = new Entities2();

        // GET: api/TRAIN_JOURNEY_STAFF
        public IQueryable<TRAIN_JOURNEY_STAFF> GetTRAIN_JOURNEY_STAFF()
        {
            db.Configuration.ProxyCreationEnabled = false;
            return db.TRAIN_JOURNEY_STAFF;
        }

        // GET: api/TRAIN_JOURNEY_STAFF/5
        [ResponseType(typeof(TRAIN_JOURNEY_STAFF))]
        public IHttpActionResult GetTRAIN_JOURNEY_STAFF(int id)
        {
            db.Configuration.ProxyCreationEnabled = false;

            TRAIN_JOURNEY_STAFF tRAIN_JOURNEY_STAFF = db.TRAIN_JOURNEY_STAFF.Find(id);
            if (tRAIN_JOURNEY_STAFF == null)
            {
                return NotFound();
            }

            return Ok(tRAIN_JOURNEY_STAFF);
        }

        // PUT: api/TRAIN_JOURNEY_STAFF/5
        [ResponseType(typeof(void))]
        public IHttpActionResult PutTRAIN_JOURNEY_STAFF(int id, TRAIN_JOURNEY_STAFF tRAIN_JOURNEY_STAFF)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            if (id != tRAIN_JOURNEY_STAFF.ID)
            {
                return BadRequest();
            }

            db.Entry(tRAIN_JOURNEY_STAFF).State = EntityState.Modified;

            try
            {
                db.SaveChanges();
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!TRAIN_JOURNEY_STAFFExists(id))
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

        // POST: api/TRAIN_JOURNEY_STAFF
        [ResponseType(typeof(TRAIN_JOURNEY_STAFF))]
        public IHttpActionResult PostTRAIN_JOURNEY_STAFF(TRAIN_JOURNEY_STAFF tRAIN_JOURNEY_STAFF)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            db.TRAIN_JOURNEY_STAFF.Add(tRAIN_JOURNEY_STAFF);

            try
            {
                db.SaveChanges();
            }
            catch (DbUpdateException)
            {
                if (TRAIN_JOURNEY_STAFFExists(tRAIN_JOURNEY_STAFF.ID))
                {
                    return Conflict();
                }
                else
                {
                    throw;
                }
            }

            return CreatedAtRoute("DefaultApi", new { id = tRAIN_JOURNEY_STAFF.ID }, tRAIN_JOURNEY_STAFF);
        }

        // DELETE: api/TRAIN_JOURNEY_STAFF/5
        [ResponseType(typeof(TRAIN_JOURNEY_STAFF))]
        public IHttpActionResult DeleteTRAIN_JOURNEY_STAFF(int id)
        {
            TRAIN_JOURNEY_STAFF tRAIN_JOURNEY_STAFF = db.TRAIN_JOURNEY_STAFF.Find(id);
            if (tRAIN_JOURNEY_STAFF == null)
            {
                return NotFound();
            }

            db.TRAIN_JOURNEY_STAFF.Remove(tRAIN_JOURNEY_STAFF);
            db.SaveChanges();

            return Ok(tRAIN_JOURNEY_STAFF);
        }

        protected override void Dispose(bool disposing)
        {
            if (disposing)
            {
                db.Dispose();
            }
            base.Dispose(disposing);
        }

        private bool TRAIN_JOURNEY_STAFFExists(int id)
        {
            return db.TRAIN_JOURNEY_STAFF.Count(e => e.ID == id) > 0;
        }
    }
}