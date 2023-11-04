import React, { useEffect, useState } from 'react';
import { notification } from 'antd';
import { getUserById, uploadAvatar, updateProfile } from '../../../api/user';

const AccountSetting = () => {
	const [avatar, setAvatar] = useState<string>('https://picsum.photos/300/300');
	const [firstName, setFirstName] = useState<string>('');
	const [lastName, setLastName] = useState<string>('');
	const [email, setEmail] = useState<string>('');
	const [phone, setPhone] = useState<string>('');
	const [newPassword, setNewPassword] = useState<string>('');
	const [confirmPassword, setConfirmPassword] = useState<string>('');
    const [address, setAddress] = useState<string>('');
    const [showNotification, setShowNotification] = useState(false);
    const [api, contextHolder] = notification.useNotification();

	const getUser = async (id: number) => {
		await getUserById(id)
			.then((res) => {
				const dataUser = res.data;
				if (dataUser.avatar) {
					setAvatar(dataUser.avatar);
				}
				const name = dataUser.name.split(' ');
				setLastName(name.pop());
				setFirstName(name.join(' '));
				setEmail(dataUser.email);
				setPhone(dataUser.phone);
                setAddress(dataUser.address);
			})
			.catch(error => console.log(error))
	}

	useEffect(() => {
		const userId = JSON.parse(localStorage.getItem('userID') || '');

		if (userId) {
			getUser(userId);
		}
	}, []);
	
	const handleUpdateAvatar = async (event: React.ChangeEvent<HTMLInputElement>) => {
		const input = event.target as HTMLInputElement;
		const userId = JSON.parse(localStorage.getItem('userID') || '');

        if (input.files?.length) {
            const file = input.files[0];
            const url = URL.createObjectURL(file);
            // Chỗ này bạn hỏi người viết api là truyền lên data gì nha. Là xong rồi á
            const data = {
                avatar: `public/avatar/${file.name}`
            }
            await uploadAvatar(userId, data).then((res) => console.log(res)).catch(error => console.log(error));
            setAvatar(url)
        } 
	}

    const openNotification = (mess: string, text_color: string, bg_color: string, title: string) => {
        setShowNotification(true);
        api.open({
          message: title,
          description: mess,
          duration: 3,
          style: {
            backgroundColor: bg_color,
            color: text_color,
          },
          onClose: () => {
            setShowNotification(false);
          },
        });
      };

    const handleUpdateProfile = async () => {
        const userId = JSON.parse(localStorage.getItem('userID') || '');
        const data = {
            name: `${firstName} ${lastName}`,
            email: email,
            phone: phone,
            password: newPassword,
            address: address,
            description: "",
        }
        await updateProfile(userId, data)
            .then((res) => {
                if(res.data.message) {
                    openNotification(res.data.message, "black", "green", "Cập Nhật Thành Công");
                } else {
                    openNotification(res.data.message, "white", "red", "Cập Nhật Thất Bại");
                }
            })
            .catch((error) => {
                openNotification(error.response.message, "white", "red", "Cập Nhật Thất Bại");
            });
    }
	
  return (
    <div>
      <div className="container mt-5">
            <div className="row">
                {contextHolder}
                <div className="col-lg-4 pb-5">
                    {/* Account Sidebar */}
                    <div className="author-card pb-3">
                        <div className="author-card-profile">
                            <div className="author-card-avatar" style={{width: '200px'}}>
                              <img style={{width: '200px'}} src={avatar} alt="Daniel Adams" />
															<input type="file" onChange={handleUpdateAvatar}/>
                            </div>
                            <div className="author-card-details">
                                <h5 className="author-card-name text-lg">{ firstName } { lastName }</h5>
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
                                <input className="form-control" type="text" id="account-fn" value={firstName} onChange={(e) => setFirstName(e.target.value)} required />
                            </div>
                        </div>
                        <div className="col-md-6">
                            <div className="form-group">
                                <label htmlFor="account-ln">Last Name</label>
                                <input className="form-control" type="text" id="account-ln" value={lastName} onChange={(e) => setFirstName(e.target.value)} required />
                            </div>
                        </div>
                        <div className="col-md-6">
                            <div className="form-group">
                                <label htmlFor="account-email">E-mail Address</label>
                                <input className="form-control" type="email" id="account-email" value={email} onChange={(e) => setLastName(e.target.value)} disabled />
                            </div>
                        </div>
                        <div className="col-md-6">
                            <div className="form-group">
                                <label htmlFor="account-phone">Phone Number</label>
                                <input className="form-control" type="text" id="account-phone" value={phone} onChange={(e) => setPhone(e.target.value)} required />
                            </div>
                        </div>
                        <div className="col-md-6">
                            <div className="form-group">
                                <label htmlFor="account-pass">New Password</label>
                                <input className="form-control" type="password" value={newPassword} onChange={(e) => setNewPassword(e.target.value)} id="account-pass" />
                            </div>
                        </div>
                        <div className="col-md-6">
                            <div className="form-group">
                                <label htmlFor="account-confirm-pass">Confirm Password</label>
                                <input className="form-control" type="password" value={confirmPassword} onChange={(e) => setConfirmPassword(e.target.value)} id="account-confirm-pass" />
                            </div>
                        </div>
                        <div className="col-md-6">
                            <div className="form-group">
                                <label htmlFor="account-confirm-pass">Address</label>
                                <input className="form-control" type="text" value={address} onChange={(e) => setAddress(e.target.value)} id="account-address" />
                            </div>
                        </div>
                        <div className="col-12">
                            <hr className="mt-2 mb-3" />
                            <div className="d-flex flex-wrap justify-content-between align-items-center">
                                
                                <button className="btn btn-style-1 btn-primary" type="button" onClick={handleUpdateProfile}>Update Profile</button>
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