import React, { Component } from 'react';
import { Switch, Route, Link } from 'react-router-dom';
import 'bootstrap/dist/css/bootstrap.min.css';
import './App.css';

import AuthService from './services/auth.service';
import SignIn from './components/signIn.component';
import Profile from './components/profile.component';

import EventBus from './common/EventBus';

class App extends Component {

  constructor(props) {
    super(props);
    this.signOut = this.signOut.bind(this);

    this.state = {
      currentUser: undefined,
    };
  }

  componentDidMount() {
    const user = AuthService.getCurrentUser();

    if (user) {
      this.setState({
        currentUser: user,
      });
    }

    EventBus.on('signOut', () => {
      this.signOut();
    });
  }

  signOut() {
    AuthService.signOut();
    this.setState({
      currentUser: undefined,
    });
  }

  render() {
    const { currentUser } = this.state;
    return (
      <div className='App d-flex flex-column min-vh-100'>
        <nav className='navbar navbar-expand navbar-dark bg-primary'>
          <div className='container'>
            <Link to={'/'} className='navbar-brand'>
              Caffeine Tracker
            </Link>
            {currentUser ? (
              <ul className='navbar-nav ms-auto'>
                <li className='nav-item'>
                  <Link to={'/profile'} className='nav-link'>
                    {currentUser.username}
                  </Link>
                </li>
                <li className='nav-item'>
                  <a href='/signIn' className='nav-link' onClick={this.signOut}>
                    Sign Out
                  </a>
                </li>
              </ul>
            ) : (
              <ul className='navbar-nav ms-auto'>
                <li className='nav-item'>
                  <Link to={'/signIn'} className='nav-link'>
                    Sign In
                  </Link>
                </li>
                <li className='nav-item'>
                  <Link to={'/signUp'} className='nav-link'>
                    Sign Up
                  </Link>
                </li>
              </ul>
            )}
          </div>
        </nav>


        <div className='App-content container mt-3 mb-3 flex-grow-1'>
          <Switch>
            <Route exact path='/signIn' component={SignIn} />
            <Route exact path='/profile' component={Profile} />
          </Switch>
        </div>
        <footer className='App-footer navbar-dark bg-primary'>
          <div className='container text-light'>
            <div className='row justify-content-center'>
              <div className='col-sm-12 col-md-6 col-lg-3'>&copy; Random engineer</div>
            </div>
          </div>
        </footer>
      </div>
    );
  }
}

export default App;
