import React, { Component } from 'react';
import { Redirect } from 'react-router-dom';
import AuthService from '../services/auth.service';

export default class Profile extends Component {
    constructor(props) {
        super(props);

        this.state = {
            redirect: null,
            userReady: false,
            currentUser: { username: '' }
        };
    }

    componentDidMount() {
        const currentUser = AuthService.getCurrentUser();
        if (!currentUser) this.setState({ redirect: '/home' });
        this.setState({ currentUser: currentUser, userReady: true })
    }

    render() {
        if (this.state.redirect) {
            return <Redirect to={this.state.redirect} />
        }

        const { currentUser } = this.state;

        return (
            <div className='row justify-content-center'>
                <div className='col-sm-12 col-md-6 col-lg-3'>
                    <div className='card card-container border-0'>
                        <img
                            src='//ssl.gstatic.com/accounts/ui/avatar_2x.png'
                            alt='profile-img'
                            className='profile-img-card'
                        />

                        {(this.state.userReady) ?
                            <div>
                                <header className='jumbotron'>
                                    <h3>
                                        <strong>{currentUser.user_name}</strong> Profile
                                    </h3>
                                </header>
                                <p>
                                    <strong>Email:</strong>{' '}
                                    {currentUser.email}
                                </p>
                            </div> : null}
                    </div>
                </div>
            </div>
        );
    }
}