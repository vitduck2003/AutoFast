import React from 'react'

const AccountSetting = () => {
  return (
    <div>
      <div className="container mt-5">
            <div className="row">
                <div className="col-lg-4 pb-5">
                    {/* Account Sidebar */}
                    <div className="author-card pb-3">
                        <div className="author-card-profile">
                            <div className="author-card-avatar">
                                <img style={{width: '200px'}} src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="Daniel Adams" />
                            </div>
                            <div className="author-card-details">
                                <h5 className="author-card-name text-lg">Daniel Adams</h5>
                                <span className="author-card-position">Joined February 06, 2017</span>
                            </div>
                        </div>
                    </div>
                    <div style={{width: '200px'}} className="wizard">
                        <nav className="list-group list-group-flush">
                          
                            <a className="list-group-item active" href="#">
                                <i className="fe-icon-user text-muted"></i>Profile Settings
                            </a>
                            <a className="list-group-item" href="#">
                                <i className="fe-icon-heart mr-1 text-muted"></i>My Oder
                            </a>
                            
                        </nav>
                    </div>
                </div>
                {/* Profile Settings */}
                <div className="col-lg-8 pb-5">
                    <form className="row">
                        <div className="col-md-6">
                            <div className="form-group">
                                <label htmlFor="account-fn">First Name</label>
                                <input className="form-control" type="text" id="account-fn" value="Daniel" required />
                            </div>
                        </div>
                        <div className="col-md-6">
                            <div className="form-group">
                                <label htmlFor="account-ln">Last Name</label>
                                <input className="form-control" type="text" id="account-ln" value="Adams" required />
                            </div>
                        </div>
                        <div className="col-md-6">
                            <div className="form-group">
                                <label htmlFor="account-email">E-mail Address</label>
                                <input className="form-control" type="email" id="account-email" value="daniel.adams@example.com" disabled />
                            </div>
                        </div>
                        <div className="col-md-6">
                            <div className="form-group">
                                <label htmlFor="account-phone">Phone Number</label>
                                <input className="form-control" type="text" id="account-phone" value="+7 (805) 348 95 72" required />
                            </div>
                        </div>
                        <div className="col-md-6">
                            <div className="form-group">
                                <label htmlFor="account-pass">New Password</label>
                                <input className="form-control" type="password" id="account-pass" />
                            </div>
                        </div>
                        <div className="col-md-6">
                            <div className="form-group">
                                <label htmlFor="account-confirm-pass">Confirm Password</label>
                                <input className="form-control" type="password" id="account-confirm-pass" />
                            </div>
                        </div>
                        <div className="col-12">
                            <hr className="mt-2 mb-3" />
                            <div className="d-flex flex-wrap justify-content-between align-items-center">
                                
                                <button className="btn btn-style-1 btn-primary" type="button">Update Profile</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  )
}

export default AccountSetting