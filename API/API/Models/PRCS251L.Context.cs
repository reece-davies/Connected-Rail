﻿//------------------------------------------------------------------------------
// <auto-generated>
//     This code was generated from a template.
//
//     Manual changes to this file may cause unexpected behavior in your application.
//     Manual changes to this file will be overwritten if the code is regenerated.
// </auto-generated>
//------------------------------------------------------------------------------

namespace API.Models
{
    using System;
    using System.Data.Entity;
    using System.Data.Entity.Infrastructure;
    
    public partial class Entities2 : DbContext
    {
        public Entities2()
            : base("name=Entities2")
        {
        }
    
        protected override void OnModelCreating(DbModelBuilder modelBuilder)
        {
            throw new UnintentionalCodeFirstException();
        }
    
        public virtual DbSet<ADMINISTRATOR> ADMINISTRATORS { get; set; }
        public virtual DbSet<API_TOKENS> API_TOKENS { get; set; }
        public virtual DbSet<BOOKING> BOOKINGS { get; set; }
        public virtual DbSet<CARRIAGE> CARRIAGES { get; set; }
        public virtual DbSet<LOCATION> LOCATIONS { get; set; }
        public virtual DbSet<PASSENGER> PASSENGERS { get; set; }
        public virtual DbSet<STAFF> STAFFs { get; set; }
        public virtual DbSet<TRAIN_CARRIAGES> TRAIN_CARRIAGES { get; set; }
        public virtual DbSet<TRAIN_COMPANIES> TRAIN_COMPANIES { get; set; }
        public virtual DbSet<TRAIN_JOURNEY> TRAIN_JOURNEY { get; set; }
        public virtual DbSet<TRAIN_JOURNEY_STAFF> TRAIN_JOURNEY_STAFF { get; set; }
        public virtual DbSet<TRAIN> TRAINS { get; set; }
    }
}
