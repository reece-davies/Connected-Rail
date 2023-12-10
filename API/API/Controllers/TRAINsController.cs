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
    public class TRAINsController : ApiController
    {
        private Entities2 db = new Entities2();

        // GET: api/TRAINs
        public IQueryable<TRAIN> GetTRAINS()
        {
            db.Configuration.ProxyCreationEnabled = false;
            return db.TRAINS;
        }

        // GET: api/TRAINs/5
        [ResponseType(typeof(TRAIN))]
        public IHttpActionResult GetTRAIN(int id)
        {
            db.Configuration.ProxyCreationEnabled = false;

            TRAIN tRAIN = db.TRAINS.Find(id);
            if (tRAIN == null)
            {
                return NotFound();
            }

            return Ok(tRAIN);
        }

        // PUT: api/TRAINs/5
        [ResponseType(typeof(void))]
        public IHttpActionResult PutTRAIN(int id, TRAIN tRAIN)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            if (id != tRAIN.ID)
            {
                return BadRequest();
            }

            db.Entry(tRAIN).State = EntityState.Modified;

            try
            {
                db.SaveChanges();
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!TRAINExists(id))
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

        // POST: api/TRAINs
        [ResponseType(typeof(TRAIN))]
        public IHttpActionResult PostTRAIN(TRAIN tRAIN)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            db.TRAINS.Add(tRAIN);

            try
            {
                db.SaveChanges();
            }
            catch (DbUpdateException)
            {
                if (TRAINExists(tRAIN.ID))
                {
                    return Conflict();
                }
                else
                {
                    throw;
                }
            }

            return CreatedAtRoute("DefaultApi", new { id = tRAIN.ID }, tRAIN);
        }

        // DELETE: api/TRAINs/5
        [ResponseType(typeof(TRAIN))]
        public IHttpActionResult DeleteTRAIN(int id)
        {
            TRAIN tRAIN = db.TRAINS.Find(id);
            if (tRAIN == null)
            {
                return NotFound();
            }

            db.TRAINS.Remove(tRAIN);
            db.SaveChanges();

            return Ok(tRAIN);
        }

        protected override void Dispose(bool disposing)
        {
            if (disposing)
            {
                db.Dispose();
            }
            base.Dispose(disposing);
        }

        private bool TRAINExists(int id)
        {
            return db.TRAINS.Count(e => e.ID == id) > 0;
        }
    }
}